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
		token_frag = token[0:100]

		user = User.query.filter_by(token = token_frag).first()

		if (user == None):
			newUser = User(token = token_frag)
			db.session.add(newUser)
			db.session.commit()
			user = User.query.filter_by(token = token_frag).first()

		session['token'] = user.token

		return redirect("/report")
	else:
		return render_template('signIn.html')

@app.route("/", methods=['GET'])
@app.route("/report", methods=['GET'])
def report():
	# Only allow user to come here if they are logged in
	if (session.get('token')):
		# If user is directed to the report page
		return render_template('map.html')
	else:
		return redirect('/login')


@app.route("/testReports", methods=['GET','POST'])
def testReports():
	if (session.get('token')):
		user = User.query.filter_by(token=session['token']).first()
		reports = Report.query.filter_by(user=user).all()
		return render_template('table.html', reports = reports)
	else:
		return redirect('/login')

@app.route("/_getMarkers", methods=['GET','POST'])
def getMarkers():
	reports = Report.query.all()
	data = []

	for report in reports:
		epoch = report.event_dt.strftime('%s')
		data.append([report.latitude, report.longitude, report.text, report.isEmergency, epoch])

	return jsonify(result = data)


@app.route("/_submitReport")
def submitReport():
	text = request.args.get('description', 0, type=str)
	isEm = request.args.get('isEmergency',0, type=str)
	isAm = request.args.get('anonymous', 0, type=str)
	latitude = request.args.get('lat', 0, type=float)
	longitude = request.args.get('long', 0, type=float)

	user = User.query.filter(User.token == session["token"]).first()

	if (user == None):
		return jsonify(result = "NO USER")


	isEmergency = (isEm == "true")
	isAnonymous = (isAm == "true")

	newReport = Report(
		latitude = latitude,
		longitude = longitude,
		event_dt = datetime.now(),
		text = text,
		isEmergency = isEmergency,
		isAnonymous = isAnonymous,
		user = user
	)

	db.session.add(newReport)
	db.session.commit()

	return jsonify(result = "Finished")


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

# Model for users
class User(db.Model):
	__tablename__ = "users"
	id = db.Column(db.Integer, primary_key = True)
	token = db.Column(db.String(512))
	reports = db.relationship("Report", back_populates="user")


if __name__ == "__main__":
	app.run(port=CONFIG.PORT,threaded=True)
