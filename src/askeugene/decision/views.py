# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.shortcuts import render, render_to_response
from django.template.context import RequestContext
from django.views.generic.base import View
from decision_engine.settings import DEBUG

# Create your views here.
class Decision(View):
    def __init__(self):
        View.__init__(self)
        self.current_request = None
        self.profile = None
        self.parameter_dict = {}

    def dispatch(self, request, *args, **kwargs):
        self.parameter_dict = dict()
        self.current_request = request
        self.parameter_dict['DEBUG'] = DEBUG
        return super(Decision, self).dispatch(request, *args, **kwargs)

class GuestSignUp(Decision):
    def get(self , vid):

        print vid
        return render_to_response('guest/register.html', self.parameter_dict)

class GuestVote(Decision):
    def get(self , vid):

        print vid
        return render_to_response('guest/vote.html', self.parameter_dict)