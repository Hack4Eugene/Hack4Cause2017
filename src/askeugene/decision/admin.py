# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from models import Decision,  DecisionAnswers

from django.contrib import admin



class InlineDecisionAnswers(admin.StackedInline):
    model = DecisionAnswers
    extra = 1

class DecisionAdmin (admin.ModelAdmin):
    list_display = ['label', 'event', 'start_time', 'end_time', 'published', 'expired']
    inlines = [InlineDecisionAnswers]


class DecisionAnswersAdmin (admin.ModelAdmin):
    list_display = ['name', 'decision']

admin.site.register(Decision, DecisionAdmin)
admin.site.register(DecisionAnswers, DecisionAnswersAdmin)

# Register your models here.
