#!/usr/bin/env python
import time
from flask_script import Manager

from emcit import app, models
from emcit.database import Model, engine

manager = Manager(app)


@manager.command
@manager.option('-n', '--name', help='First and/or Last Name')
@manager.option('-o', '--org', help='User\'s organization')
@manager.option('-e', '--email', help='Email')
@manager.option('-c', '--number', help='Phone Number')
@manager.option('-p', '--password', help='Password')
@manager.option('-r', '--role', help='Set role')
def create_user(name, org, email, number, password, role):
    user = models.User(
        name, org, email, password, number, [], role)
    user.save()


@manager.command
def create_db():
    Model.metadata.create_all(bind=engine)


def next_item(l, i):
    return l[i % len(l)]


locations = ["Hotel Eastlund, Northeast Grand Avenue, Portland, OR",
             "Lancaster Mall, Lancaster Drive Northeast, Salem, OR"]
lats = [45.55060191034006, 45.504421980400835, 45.508271755944975, 45.481317798141255, 45.45820413751095,
        45.48324350868221, 45.47939202177826, 45.408092022812276, 45.35600542155823, 45.31352900692261,
        45.21493841637804, 45.13555516012536, 45.01336034905036, 44.96285457777543, 44.92786297463683,
        44.896741421341964, 44.92397370210939, 44.968684437948376, 45.20332826663052, 45.29421101337773,
        45.34828480683999, 44.9336963896947, 44.74868389996833, 44.64520822374406, 44.64520822374406,
        44.680371641890375, 44.60611274517393, 44.58655513209545, 44.57873024377564, 44.61784415342069,
        44.56699093657141, 45.081278612418764, 45.28841433167348, 45.51212126820532, 45.50057194157223,
        45.583289756006316, 45.487094732298374, 45.11036175291052, 45.236217535866025, 45.11423838585088,
        45.22461173085722, 45.5679096098613, 45.40616374516014, 45.35407536661815, 45.298075138707965,
        45.34635448859446, 45.178164812206376, 44.98422783516651, 45.09873027414909, 45.24782097102814]
lngs = [-122.59094238281251, -122.60467529296876, -122.66235351562501, -122.63488769531251, -122.61016845703126,
        -122.57171630859376, -122.72552490234376, -122.75299072265626, -122.62664794921876, -122.78594970703126,
        -122.82989501953126, -122.89581298828126, -123.00842285156251, -123.04412841796876, -123.09356689453126,
        -123.03314208984376, -122.94525146484376, -123.04687500000001, -123.21441650390626, -122.96722412109376,
        -122.34924316406251, -123.2391357421875, -122.48382568359376, -123.08807373046876, -123.12377929687501,
        -123.07434082031251, -123.03039550781251, -123.05786132812501, -123.25836181640626, -123.30780029296876,
        -123.25286865234376, -122.91503906250001, -122.96722412109376, -123.02764892578126, -122.38494873046876,
        -122.42340087890626, -122.72003173828126, -122.92327880859376, -122.72552490234376, -122.82440185546876,
        -123.18695068359376, -122.42889404296876, -122.70904541015625, -122.83538818359375, -122.96722412109376,
        -123.18145751953126, -122.82165527343751, -122.93426513671876, -122.94799804687501, -122.68157958984376]

categories = ["victim", "suspicious_person", "buyer"]
height = [36, 39, 42, 45, 48, 51, 54, 57, 60, 63, 66, 69, 72, 75, 78, 81]
weight = [130, 140, 150, 160, 170, 180, 190, 200, 210, 220, 230, 240]
sex = ['male', 'female']
hair_color = ['blond', 'brown', 'red', 'black', 'gray']
eye_color = ['amber', 'blue', 'brown', 'gray', 'green', 'hazel', 'red_violet']

make_models = [['ford', 'f150'], ['ford', 'pinto'], ['honda', 'accord'], ['honda', 'civic'], ['subaru', 'forester'],
               ['subaru', 'outback']]
car_colors = ['blue', 'red', 'yellow']
user_ids = [1, 2, 3]


@manager.command
def simple_seed_db():
    # Seed an admin, analyst, and a reporter
    models.User(
        'Admin Alice', 'alice@example.com', '1234', '5415551234',
        'admin').save()
    models.User(
        'Analyst Adam', 'adam@example.com', '1234', '5415551234',
        'analyst').save()
    models.User(
        'Repoter Rob', 'rob@example.com', '1234', '5415551234',
        'reporter').save()


@manager.command
def seed_db():
    simple_seed_db()

    for [s, i] in [[str(i), i] for i in range(50)]:
        models.Report.from_json({
            "date": time.time() * 1000,
            "location": next_item(locations, i),
            "room_number": "12" + s,
            "geo_latitude": lats[i],
            "geo_longitude": lngs[i],
            "user_id": next_item(user_ids, i),
            "people": [{
                "name": "name" + s,
                "category": next_item(categories, i),
                "height": next_item(height, i),
                "weight": next_item(weight, i),
                "hair_color ": next_item(hair_color, i),
                "eye_color": next_item(eye_color, i),
                "sex": next_item(sex, i)
            }],
            "vehicles": [{
                "make": next_item(make_models, i)[0],
                "model": next_item(make_models, i)[1],
                "color": next_item(car_colors, i)
            }]
        }).save()


@manager.command
def drop_db():
    Model.metadata.drop_all(bind=engine)


@manager.command
def reseed_db():
    drop_db()
    create_db()
    seed_db()


@manager.command
def simple_reseed_db():
    drop_db()
    create_db()
    simple_seed_db()


if __name__ == '__main__':
    manager.run()
