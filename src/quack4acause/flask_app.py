# communityReportsApp.py

from flask import Flask, request, redirect, jsonify, session, render_template
from flask_sqlalchemy import SQLAlchemy

from datetime import datetime
import logging
import CONFIG
import uuid

###############
### Globals ###
###############
app = Flask(__name__)
app.secret_key = str(uuid.uuid4())
app.debug = CONFIG.DEBUG
app.logger.setLevel(logging.DEBUG)

# Database Globals
SQLALCHEMY_DATABASE_URI = "mysql+mysqlconnector://{username}:{password}@{hostname}/{databasename}".format(
	username="change4change",
	password="noSleep69",
	hostname="change4change.mysql.pythonanywhere-services.com",
	databasename="change4change$reports",
)
app.config["SQLALCHEMY_DATABASE_URI"] = SQLALCHEMY_DATABASE_URI
app.config["SQLALCHEMY_POOL_RECYCLE"] = 299

db = SQLAlchemy(app)

###############
### Routes  ###
###############

@app.route("/login", methods=['GET','POST'])
def login():
	if (session.get('token')):
		return redirect("/report")
	# User is trying to log in to Google
	elif (request.method == 'POST'):
		token = request.form.get('token')

		user = User.query.filter(User.token == token)
		if (user == None):
			newUser = User(token = token)
			db.session.add(newUser)
			db.session.commit()
			user = User.query.filter(User.token == token)

		session['token'] = token

		return redirect("/report")
	else:
		return render_template('signIn.html')

@app.route("/", methods=['GET','POST'])
@app.route("/report", methods=['GET','POST'])
def report():
	if (session.get('token')):
		# If user is directed to the report page
		if (request.method == 'GET'):
			return render_template('map.html')
		# If the user has posted a report form
		else:
			latitude = request.form.get('latitude')
			longitude = request.form.get('longitude')
			reportText = request.form.get('reportText')
			isEmergency = request.form.get('isEmergency')
			isAnonymous = request.form.get('anonymous')

			user = User.query.filter(User.token == session["token"])

			if (user == None):
				return render_template('error.html', error="No user in system!")

			# Create new report row
			newReport = Report(
				latitude = latitude,
				longitude = longitude,
				event_dt = datetime.now(),
				text = reportText,
				isEmergency = isEmergency,
				isAnonymous = isAnonymous,
				user = user,
				human_time = str(arrow.get(datetime.now()).humanize())
			)

			db.session.add(newReport)
			db.session.commit()

			# Render report page with report confirmation
			return render_template('map.html', success = True)
	else:
		return redirect('/login')

@app.route("/testReports", methods=['GET','POST'])
def testReports():
	reports = Report.query.all()
	return render_template('table.html', reports = reports)

@app.route("/_getMarkers", methods=['GET','POST'])
def getMarkers():
	reports = Report.query.all()
	data = []

	for report in reports:
		epoch = report.event_dt.strftime('%s')

		if (report.isEmergency):
			data.append([report.latitude, report.longitude, report.text, "Crime", epoch])
		else:
			data.append([report.latitude, report.longitude, report.text, "Event", epoch])

	return jsonify(result = data)


@app.route("/_submitReport")
def submitReport():
	text = request.args.get('description', 0, type=str)
	isEmergency = request.args.get('type',0, type=bool)
	isAnonymous = request.args.get('anonymous', 0, type=bool)
	latitude = request.args.get('lat', 0, type=float)
	longitude = request.args.get('long', 0, type=float)

	user = User.query.filter(User.token == session["token"])

	if (user == None):
		return render_template('error.html', error="No user in system!")

	newReport = Report(
		latitude = latitude,
		longitude = longitude,
		event_dt = datetime.now(),
		text = text,
		isEmergency = isEmergency,
		isAnonymous = isAnonymous,
		user = user,
		human_time = str(arrow.get(datetime.now()).humanize())
	)

	db.session.add(newReport)
	db.session.commit()

	return jsonify(result = True)

@app.route("/mapFile")
def mapFile():
	return render_template('map.html')

@app.route("/signIn")
def signIn():
	return render_template('signIn.html')

@app.route("/deleteReport", methods=['POST'])
def deleteReport():
	reportID = request.form.get('id')
	Report.query.filter_by(id=reportID).delete()
	db.session.commit()
	return redirect('/testReports')

###############
### Models  ###
###############

# Database model declaration for report data
class Report(db.Model):
	__tablename__ = "reports"
	id = db.Column(db.Integer, primary_key = True)

	latitude = db.Column(db.Float)
	longitude = db.Column(db.Float)
	event_dt = db.Column(db.DateTime)
	text = db.Column(db.String(4096))
	isEmergency = db.Column(db.Boolean)
	isAnonymous = db.Column(db.Boolean)
	user_id = db.Column(db.Integer, db.ForeignKey('users.id'))
	user = db.relationship("User", back_populates="reports")
	human_time = db.Column(db.String(4096))

	def humanize_time(self):
        self.event_dt = arrow.get(event_dt).humanize()

# Model for users
class User(db.Model):
	__tablename__ = "users"
	id = db.Column(db.Integer, primary_key = True)
	token = db.Column(db.String(512))
	reports = db.relationship("Report", back_populates="user")


if __name__ == "__main__":
	app.run(port=CONFIG.PORT,threaded=True)
