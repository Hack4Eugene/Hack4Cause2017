"""decision_engine URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/1.11/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  url(r'^$', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  url(r'^$', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.conf.urls import url, include
    2. Add a URL to urlpatterns:  url(r'^blog/', include('blog.urls'))
"""
from django.conf.urls import url
from django.contrib import admin
import venue.views as venue
from django.conf.urls import include

urlpatterns = [
    url(r'^dashboard/(?P<vid>\d+)/', venue.Dashboard.as_view(), name='dashboard'),
    url(r'^events/(?P<vid>\d+)/', venue.Events.as_view(), name='events'),
    url(r'^event_detail/(?P<eid>\d+)/', venue.EventDetail.as_view(), name='event_detail'),
    url(r'^un-publish-poll/(?P<decision>\d+)/', venue.un_publish_poll, name='un_publish_poll'),
    url(r'^publish-poll/(?P<decision>\d+)/', venue.publish_poll, name='publish_poll'),
    url(r'^update-decision/(?P<did>\d+)/', venue.EventDetail.as_view(), name='update_decision'),
    url(r'^update-decision-answer/(?P<daid>\d+)/', venue.EventDetail.as_view(), name='update_decision_answer'),
]
