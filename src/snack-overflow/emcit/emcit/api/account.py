"""User login/logout/profile etc API"""
from flask import Blueprint, request, jsonify
from flask_login import (
    login_user, logout_user, login_required, current_user
)

from emcit.models import User
from emcit.util import api_error, validate
from emcit.resources import AccountResource
from emcit.schemas import login_schema

account_api = Blueprint('account_api', __name__)


@account_api.route('/current_user', methods=['GET'])
def get_current_user():
    user = None

    if current_user.is_authenticated:
        user = current_user

    return jsonify(AccountResource(user)) if user else '', 404


@account_api.route('/login', methods=['POST'])
@validate(login_schema)
def login():
    json = request.get_json()

    if 'email' in json:
        user = User.get_by_email(json.get('email').lower())

        if user is not None and user.check_password(json.get('password')):
            login_user(user)
            return jsonify(AccountResource(user))

    return api_error(dict(form=['Invalid username/password.']))


@account_api.route('/logout', methods=['POST'])
@login_required
def logout():
    logout_user()
    return '', 200
