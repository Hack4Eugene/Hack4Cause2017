# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models
from django.contrib.auth.models import User
from libraries.data import STATE_CHOICES
from decision.models import DecisionAnswers

# Create your models here.
class Guest(models.Model):
    #user = models.ForeignKey(User)
    first_name = models.CharField(max_length=255, null=True)
    last_name = models.CharField(max_length=255, null=True)
    ip = models.CharField(max_length=255, null=True)
    address_street = models.CharField(max_length=255, null=True)
    city = models.CharField(max_length=255, null=True)
    state = models.CharField(max_length=2, choices=STATE_CHOICES)
    zip = models.CharField(max_length=10)
    date_created = models.DateTimeField(auto_now_add=True)

def __unicode__(self):
    return u"%s" % self.user

class GuestAnswers(models.Model):
    guest = models.ForeignKey(Guest)
    decision_answers = models.ForeignKey(DecisionAnswers)

