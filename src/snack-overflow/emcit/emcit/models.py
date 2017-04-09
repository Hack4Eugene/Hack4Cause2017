from datetime import datetime, timedelta
from sqlalchemy import (
    Column, DateTime, Enum, ForeignKey, Integer, String, Table, Text, desc,
    Boolean, PrimaryKeyConstraint, Float
)
from sqlalchemy.orm import backref, relationship
from werkzeug.security import check_password_hash, generate_password_hash
from emcit.database import Model


class User(Model):
    """
    User Model.

    Required parameters:
        - email, password
    """

    __tablename__ = 'user'
    id = Column(Integer, primary_key=True)
    created_at = Column(DateTime, default=datetime.utcnow)
    updated = Column(DateTime, default=datetime.utcnow)
    name = Column(String(255), nullable=False)
    email = Column(String(255), nullable=False, unique=True)
    password = Column(Text, nullable=False)
    phone_number = Column(String(20), nullable=True)
    role = Column(Enum('admin', 'analyst', 'reporter', name='user_role'), default='reporter')

    def __init__(self, name, email, password, phone_number, role):
        self.name = name
        self.email = email.lower()
        self.set_password(password)
        self.phone_number = phone_number
        self.role = role

    def check_password(self, password):
        """Check a user's password (includes salt)."""
        return check_password_hash(self.password, password)

    def get_id(self):
        """Get the User id in unicode or ascii."""
        try:
            return unicode(self.id)
        except NameError:
            return str(self.id)

    def set_password(self, password):
        """Using pbkdf2:sha512, hash 'password'."""
        self.password = generate_password_hash(
            password=password,
            method='pbkdf2:sha512',
            salt_length=128
        )

    @property
    def is_admin(self):
        return self.role == 'admin'

    @property
    def is_analyst(self):
        return self.role == 'analyst'

    @property
    def is_reporter(self):
        return self.role == 'reporter'

    @property
    def is_authenticated(self):
        """Authenticaition check."""
        return True

    @property
    def is_active(self):
        """Active check."""
        return True

    @property
    def is_anonymous(self):
        """Anonimity check."""
        return False

    @classmethod
    def get_users(cls):
        return cls.query.order_by(desc(cls.created_at)).all()

    @classmethod
    def get_by_email(cls, email):
        """Return user based on email."""
        return cls.query.filter(cls.email == email).first()

    @classmethod
    def get_by_id(cls, id):
        return cls.query.get(id)

    @staticmethod
    def from_json(json):
        return User(
            json.get('name'),
            json.get('email'),
            json.get('password'),
            json.get('phone_number'),
            json.get('role')
        )

    def __repr__(self):
        """Return <User: %(email)."""
        return '<User %s>' % (self.email)


class Person(Model):
    """
    Person Model, used in reports to identity suspicious people, victims, and buyers.

    Required parameters:
        - category
    """

    __tablename__ = 'person'
    id = Column(Integer, primary_key=True)
    report_id = Column(Integer, ForeignKey('report.id'))
    created_at = Column(DateTime, default=datetime.utcnow)
    updated = Column(DateTime, default=datetime.utcnow)
    name = Column(String(255), nullable=True)
    category = Column(Enum('suspicious_person', 'victim', 'buyer', name='person_type'), default=None, nullable=False)
    height = Column(String(255), nullable=True)
    weight = Column(String(255), nullable=True)
    hair_color = Column(String(255), nullable=True)
    hair_length = Column(String(255), nullable=True)
    eye_color = Column(String(255), nullable=True)
    skin = Column(String(255), nullable=True)
    sex = Column(String(255), nullable=True)

    def __init__(self, report_id, name, category, height, weight, hair_color, hair_length, eye_color, skin, sex):
        self.report_id = report_id
        self.name = name
        self.category = category
        self.height = height
        self.weight = weight
        self.hair_color = hair_color
        self.hair_length = hair_length
        self.eye_color = eye_color
        self.skin = skin
        self.sex = sex

    @property
    def is_suspicious(self):
        return self.category == 'suspicious_person'

    @property
    def is_victim(self):
        return self.category == 'victim'

    @property
    def is_buyer(self):
        return self.category == 'buyer'

    @staticmethod
    def from_json(json):
        return Person(
            json.get('report_id'),
            json.get('name'),
            json.get('category'),
            json.get('height'),
            json.get('weight'),
            json.get('hair_color'),
            json.get('hair_length'),
            json.get('eye_color'),
            json.get('skin'),
            json.get('sex')
        )

    def __repr__(self):
        return '<Person %s>' % (self.id)


class Vehicle(Model):
    """
    Vehicle Model, used in reports to identity vehicles of suspicious people, victims, and buyers.
    """

    __tablename__ = 'vehicle'
    id = Column(Integer, primary_key=True)
    report_id = Column(Integer, ForeignKey('report.id'))
    created_at = Column(DateTime, default=datetime.utcnow)
    updated = Column(DateTime, default=datetime.utcnow)
    make = Column(String(50), nullable=True)
    model = Column(String(50), nullable=True)
    color = Column(String(50), nullable=True)
    license_plate = Column(String(50), nullable=True)

    @staticmethod
    def from_json(json):
        return Vehicle(
            json.get('report_id'),
            json.get('make'),
            json.get('model'),
            json.get('color'),
            json.get('license_plate')
        )

    def __init__(self, report_id, make, model, color, license_plate):
        self.report_id = report_id
        self.make = make
        self.model = model
        self.color = color
        self.license_plate = license_plate

    def __repr__(self):
        return '<Vehicle %s>' % (self.id)


class Report(Model):
    """
    Report Model, this is the class representing the main form that people submit during an incident.
    """

    __tablename__ = 'report'
    id = Column(Integer, primary_key=True)
    created_at = Column(DateTime, default=datetime.utcnow)
    updated = Column(DateTime, default=datetime.utcnow)
    date = Column(DateTime, default=datetime.utcnow)
    location = Column(String(255), nullable=True)
    room_number = Column(String(255), nullable=True)
    geo_latitude = Column(Float(precision=53), nullable=True)
    geo_longitude = Column(Float(precision=53), nullable=True)
    vehicles = relationship("Vehicle", backref="report")
    people = relationship("Person", backref="report")
    details = Column(String(255), nullable=True)
    user_id = Column(Integer, ForeignKey('user.id'))
    user = relationship("User", backref="reports")

    def __init__(self, date, location, room_number, geo_latitude, geo_longitude, vehicles, people, details, user_id):
        self.date = date
        self.location = location
        self.room_number = room_number
        self.geo_latitude = geo_latitude
        self.geo_longitude = geo_longitude
        self.vehicles = vehicles
        self.people = people
        self.details = details
        self.user_id = user_id

    @staticmethod
    def from_json(json):
        return Report(
            datetime.utcfromtimestamp(json.get('date') / 1000.0),
            json.get('location'),
            json.get('room_number'),
            json.get('geo_latitude'),
            json.get('geo_longitude'),
            map(Vehicle.from_json, json.get('vehicles', [])),
            map(Person.from_json, json.get('people', [])),
            json.get('details'),
            json.get('user_id')
        )

    @classmethod
    def get_all(cls):
        """Return user based on email."""
        return cls.query.all()

    @classmethod
    def filter(cls, filters):
        if filters is None or len(filters) == 0:
            return cls.query.all()

        result = []

        for f in filters:
            query = cls.query
            entity = report_filter_entities[f.get('entity')]

            if entity != Report:
                query = query.join(entity)

            for key, value in f.get('values').items():
                query = query.filter(getattr(entity, key) == value)

            result += query.all()

        return result

    def __repr__(self):
        return '<Report %s>' % (self.id)


report_filter_entities = {
    'report': Report,
    'vehicle': Vehicle,
    'person': Person
}
