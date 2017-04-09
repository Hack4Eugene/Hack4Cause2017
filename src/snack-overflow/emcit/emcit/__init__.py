from flask import Flask, render_template, request, json, redirect
from urlparse import urlparse
from flask_login import (
    LoginManager, UserMixin, login_required, current_user, logout_user
)

from emcit.api import (
    account_api,
    user_api,
    report_api,
    analytics_api
)
from emcit.models import User
from emcit.resources import AccountResource

app = Flask(__name__)


try:
    app.config.from_object('config')
except:
    app.config.from_object('configdist')

app.secret_key = app.config['SECRET_KEY']
app.register_blueprint(account_api, url_prefix='/api/v1/account')
app.register_blueprint(user_api, url_prefix='/api/v1/user')
app.register_blueprint(report_api, url_prefix='/api/v1/report')
app.register_blueprint(analytics_api, url_prefix='/api/v1/analytics')

login_manager = LoginManager()

@login_manager.user_loader
def load_user(user_id):
    return User.get(user_id)

login_manager.init_app(app)

@app.route('/')
@app.route('/<path:path>')
def index(path=None):
    user = AccountResource(current_user) if current_user.is_authenticated else None
    state = json.dumps(dict(
        account=dict(
            user=user,
            loginError=dict()
        )
    ))
    if urlparse(request.url).hostname[:6] == 'mobile':
        return render_template('mobile.html', state=state)
    else:
        return render_template('desktop.html', state=state)

@app.route('/logout')
def logout():
    logout_user()
    return redirect('/')
