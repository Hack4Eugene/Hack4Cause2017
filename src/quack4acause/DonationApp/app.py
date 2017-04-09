# app.py for Change4Change
import flask
from flask import Flask, request, url_for, jsonify, render_template
from flask.ext.sqlalchemy import SQLAlchemy

from datetime import datetime

import json
import logging
import CONFIG
import uuid

###
# Globals
###
app = flask.Flask(__name__)

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

app.secret_key = str(uuid.uuid4())
app.debug = CONFIG.DEBUG
app.logger.setLevel(logging.DEBUG)


#############
####Pages####
#############

### Home Page ###
@app.route("/", methods=['GET','POST'])
@app.route("/index", methods=['GET','POST'])
def index():
	if (request.method == 'GET'):
	    app.logger.debug("Main page entry")
	    return render_template('index.html')

# Test function to test database interaction
# LATER: Will have admin authentication, then various
#        queries to show reports.
@app.route("/displayReports", methods=['GET','POST'])
def displayReports():
    results = Report.query.all()
    return render_template('DBtest.html', results = results)


@app.route("/report", methods=['GET','POST'])
def report():
	# If user is directed to the report page
	if (request.method == 'GET'):
		pass
		# return render_template('report.html')
	# If the user has posted a report form
	else:
		latitude = request.form.get('latitude')
		longitude = request.form.get('longitude')
		reportText = request.form.get('reportText')
		isEmergency = request.form.get('isEmergency')

		newReport = Report(
			latitude = latitude,
			longitude = longitude,
			event_dt = datetime.now(),
			text = reportText,
			isEmergency = isEmergency
		)
	db.session.add(newReport)
	db.session.commit()

	return render_template('index.html')

# Database model declaration for report data
class Report(db.Model):
	__tablename__ = "reports"

	id = db.Column(db.Integer, primary_key = True)

	latitude = db.Column(db.Float)
	longitude = db.Column(db.Float)
	event_dt = db.Column(db.DateTime)
	text = db.Column(db.String(4096))
	isEmergency = db.Column(db.Boolean)

if __name__ == "__main__":
    app.run(port=CONFIG.PORT,threaded=True)
