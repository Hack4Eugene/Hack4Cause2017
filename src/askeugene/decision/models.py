# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.db import models
from venue .models import Event


# Create your models here.
class Decision(models.Model):
    event = models.ForeignKey(Event)
    label = models.CharField(max_length=255, blank=True, null=True)
    question_to_be_asked = models.TextField()
    date_created = models.DateTimeField(auto_now_add=True)
    start_time = models.DateTimeField(blank=True, null=True)
    end_time   = models.DateTimeField(blank=True, null=True)
    published = models.BooleanField(default=False)
    expired = models.BooleanField(default=False)

    def __unicode__(self):
        return u"%s-%s" % (self.event,self.question_to_be_asked)


# Create your models here.
class DecisionAnswers(models.Model):
    name = models.CharField(max_length=255)
    decision = models.ForeignKey(Decision)
    date_created = models.DateTimeField(auto_now_add=True)

    def __unicode__(self):
        return u"%s" % self.name