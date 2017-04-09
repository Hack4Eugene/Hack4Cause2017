# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.contrib import admin

# Register your models here.
from models import Venue,  Event, VenueType
from decision.models import Decision

class InlineEventDecisions(admin.StackedInline):
    model = Decision
    extra = 1

class EventAdmin (admin.ModelAdmin):
    list_display = ['name', 'venue', 'number_of_external_users', 'number_of_internal_users', 'date_created']
    inlines = [InlineEventDecisions]

class InlineVenueEvents(admin.StackedInline):
    model = Event
    extra = 1

class VenueAdmin (admin.ModelAdmin):
    list_display = ['name', 'venue_type', 'city', 'state']
    inlines = [InlineVenueEvents]

admin.site.register(VenueType)
admin.site.register(Venue, VenueAdmin)
admin.site.register(Event, EventAdmin)