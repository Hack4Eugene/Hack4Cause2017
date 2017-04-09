# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models
from libraries.data import STATE_CHOICES

class VenueType(models.Model):
    name = models.CharField(max_length=255)
    def __unicode__(self):
        return u"%s" % self.name

class Venue(models.Model):
    name = models.CharField(max_length=255)
    venue_type = models.ForeignKey(VenueType)
    address_street = models.CharField(max_length=255, null=True)
    city = models.CharField(max_length=255, null=True)
    state = models.CharField(max_length=2, choices=STATE_CHOICES)
    zip = models.CharField(max_length=10)
    low_ip_range  = models.GenericIPAddressField(protocol='both', blank=True, null=True)
    high_ip_range = models.GenericIPAddressField(protocol='both', blank=True, null=True)

    def __unicode__(self):
        return u"%s" % self.name

class Event(models.Model):
    venue = models.ForeignKey(Venue)
    name = models.CharField(max_length=255)
    number_of_external_users = models.IntegerField(default=0)
    number_of_internal_users = models.IntegerField(default=0)
    requires_credentials = models.BooleanField(default=False)
    internal_only = models.BooleanField(default=False)
    can_provide_input = models.BooleanField(default=False)
    date_created = models.DateTimeField(auto_now_add=True, blank=True, null=True)

    def __unicode__(self):
        return u"%s" % self.name


