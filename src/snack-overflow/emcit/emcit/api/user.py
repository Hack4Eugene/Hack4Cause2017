"""User administration API"""
from flask import request, jsonify, Blueprint
from flask_login import current_user
from emcit.models import User
from emcit.resources import UserAdministrationResource
from emcit.util import required_access, api_error, validate
from emcit.schemas import user_schema

user_api = Blueprint('user_api', __name__)


@user_api.route('', methods=['GET'])
@required_access('admin')
def get_users():
    return jsonify(map(UserAdministrationResource, User.all()))


@user_api.route('/<int:user_id>', methods=['GET'])
@required_access('admin')
def get_user(user_id):
    return jsonify(UserAdministrationResource(User.get(user_id)))


@user_api.route('', methods=['POST'])
@required_access('admin')
@validate(user_schema)
def create_user():
    user = User.from_json(request.get_json())
    user.save()
    return jsonify(UserAdministrationResource(user))


@user_api.route('/<int:user_id>', methods=['PUT'])
@required_access('admin')
@validate(user_schema)
def update_user(user_id):
    user = User.get_by_id(user_id)

    if not user:
        return api_error('User not found', 404)

    json = request.get_json()

    if 'password' in request.json:
        user.set_password(json.get('password'))

    user.name = json.get('name')
    user.email = json.get('email')
    user.phone_number = json.get('phone_number')
    user.role = json.get('role')
    user.save()

    return jsonify(UserAdministrationResource(user))


@user_api.route('/<int:id>', methods=['DELETE'])
@required_access('admin')
def delete_user(id):
    user = User.get(id)

    if not user:
        return api_error('User not found', 404)
    if user.id == current_user.id:
        return api_error('Cannot delete self', 404)

    user.delete()

    return '', 202
