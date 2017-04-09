# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.views.generic.base import View
from decision_engine.settings import DEBUG
from django.shortcuts import render_to_response
from django.http import HttpResponse
import json


from models import Venue, Event
from decision.models import Decision, DecisionAnswers

class VenueView(View):
    def __init__(self):
        View.__init__(self)
        self.current_request = None
        self.profile = None
        self.parameter_dict = {}

    def dispatch(self, request, *args, **kwargs):
        self.parameter_dict = dict()
        self.current_request = request
        self.parameter_dict['DEBUG'] = DEBUG
        return super(VenueView, self).dispatch(request, *args, **kwargs)


class Dashboard(VenueView):
    def get(self , *args, **kwargs):
        vid = kwargs['vid']
        venue = Venue.objects.get(id=vid)
        events = Event.objects.filter(venue=venue)
        self.parameter_dict['vendor_id'] = vid
        return render_to_response('venue/dashboard.html', self.parameter_dict)


class Events(VenueView):
    def get(self, *args, **kwargs):
        vid = kwargs['vid']
        venue = Venue.objects.get(id=vid)
        events = Event.objects.filter(venue=venue)
        self.parameter_dict['vendor_id'] = vid
        self.parameter_dict['venue']     = venue
        self.parameter_dict['events']    = events
        return render_to_response('venue/events.html', self.parameter_dict)


    def post(self, *args, **kwargs):
        pass


class EventDetail(VenueView):
    def get(self , *args, **kwargs):
        eid = kwargs['eid']
        event = Event.objects.get(id=eid)
        decisions = Decision.objects.filter(event=event)
        decision_answers = DecisionAnswers.objects.filter(decision__id__in=decisions.values_list('id', flat=True))
        self.parameter_dict['decision_answers'] = decision_answers
        self.parameter_dict['decisions'] = decisions
        self.parameter_dict['vendor_id'] = event.venue.id
        self.parameter_dict['event'] = event
        self.parameter_dict['event_id'] = eid
        return render_to_response('venue/event_detail.html', self.parameter_dict)


def publish_poll(request, decision):
    decision = Decision.objects.get(id=decision)
    Decision.objects.filter(event=decision.event).update(published=False)

    decision.published = True
    decision.save()
    message = decision.event.id
    return HttpResponse(json.dumps(message), content_type='application/json')


def un_publish_poll(request, decision):
    decision = Decision.objects.get(id=decision)
    decision.published = False
    decision.save()

    message = u"Success"
    return HttpResponse(json.dumps(message), content_type='application/json')


def update_event_question(request):
    message = u"Update unsuccessful"
    return HttpResponse(json.dumps(message), content_type='application/json')



def update_event_question_answer(request):
    message = u"Update unsuccessful"
    return HttpResponse( json.dumps(message), content_type='application/json')