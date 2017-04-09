from flask import jsonify, request
from flask_login import current_user
from functools import wraps
from cerberus import Validator


def required_access(*roles):
    def templated(f):
        @wraps(f)
        def decorated(*args, **kwargs):
            if current_user.is_anonymous or current_user.role not in roles:
                return 'Access Denied.', 403
            return f(*args, **kwargs)
        return decorated
    return templated


def api_error(error=dict(message='Bad Request'), code=400):
    response = jsonify(error)
    response.status_code = code
    return response


def validate(schema):
    def templated(f):
        @wraps(f)
        def decorated(*args, **kwargs):
            v = Validator(schema)
            result = v.validate(request.get_json())
            return f(*args, **kwargs) if result else api_error(v.errors)
        return decorated
    return templated
