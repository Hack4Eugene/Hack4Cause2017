from flask import request, jsonify, Blueprint
from flask_login import current_user

from emcit.models import Report
from emcit.resources import ReportResource
from emcit.util import required_access, validate
from emcit.schemas import report_schema

report_api = Blueprint('report_api', __name__)


@report_api.route('', methods=['GET'])
@required_access('admin', 'analyst')
def get_reports():
    return jsonify(map(ReportResource, Report.get_all()))


@report_api.route('', methods=['POST'])
@required_access('admin', 'analyst', 'reporter')
@validate(report_schema)
def create_report():
    json = request.get_json()

    report = Report.from_json(json)
    report.user_id = current_user.id
    report.save()

    return jsonify(ReportResource(report))
