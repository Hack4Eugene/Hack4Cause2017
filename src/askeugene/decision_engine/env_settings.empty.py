# Board Concierge
# > Environment Settings
#
# Author: Christopher Lee + WebInvolve SRL <office@webinvolve.ro>
# Copyright: (c) 2015-2016 Master Lee Technologies. All rights reserved.

import os

# Environment Settings
# This file contains critical environment-only variables in order to run the application
# env_settings.py should never be part of GIT, yet any changes (adding new sections) should be replicated and noted here

# Change History
# 1.0 - initial build (env type, hosts, database, AWS & email settings)


def setup_env():

    # Environment and Operation Setup
    os.environ['DEPLOYMENT_TYPE'] = 'dev' # can be dev, stg or prd

    # i18n
    os.environ["I18N_ENABLED"] = 'false'
    os.environ["I18N_LANGUAGE_CODE"] = 'en-us'
    os.environ["I18N_TIME_ZONE"] = 'US/Hawaii'

    # Hosts
    os.environ['ALLOWED_HOSTS'] = "*"

    # Database Setup
    os.environ['DATABASE_ENGINE'] = 'django.db.backends.mysql'
    os.environ['DATABASE_HOST'] = 'localhost'
    os.environ['DATABASE_PORT'] = '3306'
    os.environ['DATABASE_USER'] = 'root'
    os.environ['DATABASE_PASS'] = 'password'
    os.environ['DATABASE_NAME'] = 'decision_engine'

    # AWS Settings
    os.environ["AWS_ACCESS_KEY"] = ""
    os.environ["AWS_SECRET_KEY"] = ""
    os.environ["AWS_UPLOADS_BUCKET"] = ""

    # Email Sending
    os.environ['EMAIL_BACKEND'] = 'django_smtp_ssl.SSLEmailBackend'
    os.environ['EMAIL_HOST'] = 'email-smtp.us-east-1.amazonaws.com'
    os.environ['EMAIL_HOST_PASSWORD'] = ''
    os.environ['EMAIL_HOST_USER'] = ''
    os.environ['EMAIL_PORT'] = '465'
    os.environ['EMAIL_USE_TLS'] = 'False'
    os.environ['EMAIL_USE_SSL'] = 'False'
    os.environ['DEFAULT_FROM_EMAIL'] = ''

    # Media URLs
    os.environ["MEDIA_ROOT"] = "/Volumes/MAC Secondary/Users/MasterLee/Documents/Applications/decision_engine/media/"
    os.environ["MEDIA_URL"] = '/media/'


