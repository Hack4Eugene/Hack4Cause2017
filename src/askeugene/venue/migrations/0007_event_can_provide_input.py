# -*- coding: utf-8 -*-
# Generated by Django 1.11 on 2017-04-09 15:22
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('venue', '0006_event_internal_only'),
    ]

    operations = [
        migrations.AddField(
            model_name='event',
            name='can_provide_input',
            field=models.BooleanField(default=False),
        ),
    ]
