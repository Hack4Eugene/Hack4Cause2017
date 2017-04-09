# app.py for Change4Change
import flask
from flask import Flask, request, url_for, jsonify

import json
import logging

# Date handling
import arrow

###
# Globals
###
app = flask.Flask(__name__)

import CONFIG


import uuid
app.secret_key = str(uuid.uuid4())
app.debug = CONFIG.DEBUG
app.logger.setLevel(logging.DEBUG)
#############
####Pages####
#############

### Home Page ###

@app.route("/")
@app.route("/map")
def index():
    app.logger.debug("Main page entry")
    return flask.render_template('map.html')
    

@app.route("/_submitReport")
def getReport():
    description = request.args.get('description',0, type=str)
    atype = request.args.get('type',0, type=str)
    alat = request.args.get('lat',0, type=float)
    along = request.args.get('long',0, type=float)
    anon = request.args.get('anonymous',0, type=bool)
    print anon
    return jsonify(result = alat)
    
@app.route("/_getMarkers")
def getMarkers():
    markers = [[ 44.052, -123.086, "This is a test event",True,1591709677],
        [ 44.042, -123.084, "A murder happened here",False,1490709677]]
    return jsonify(result = markers)
    
if __name__ == "__main__":
    import uuid
    app.secret_key = str(uuid.uuid4())
    app.debug = CONFIG.DEBUG
    app.logger.setLevel(logging.DEBUG)
    app.run(port=CONFIG.PORT,threaded=True)




