from django.shortcuts import render, render_to_response, redirect
from django.views.generic.base import View
from decision_engine.settings import DEBUG
from venue.models import Event
from decision.models import Decision, DecisionAnswers
from guest.models import Guest, GuestAnswers
from django.http import HttpResponse
import json
from django.views.decorators.csrf import csrf_exempt

# Create your views here.
class GuestView(View):
    def __init__(self):
        View.__init__(self)
        self.current_request = None
        self.profile = None
        self.parameter_dict = {}

    def dispatch(self, request, *args, **kwargs):
        self.parameter_dict = dict()
        self.current_request = request
        self.parameter_dict['guest_ip'] = get_client_ip(request)
        self.parameter_dict['DEBUG'] = DEBUG
        return super(GuestView, self).dispatch(request, *args, **kwargs)

class GuestSignUp(GuestView):
    def get(self , *args, **kwargs):
        eid = kwargs['eid']
        #event =
        print eid
        print self.parameter_dict['guest_ip']
        return render_to_response('guest/register.html', self.parameter_dict)

class GuestVote(GuestView):
    def get(self , request, eid):

        event = Event.objects.get(id=eid)
        self.parameter_dict['event'] = event

        self.parameter_dict['notification_type'] = 'success'

        if not DEBUG:
            if event.internal_only:
                if event.venue.low_ip_range:
                    if event.venue.low_ip_range != self.parameter_dict['guest_ip']:
                        return render_to_response('guest/invalid_ip.html', self.parameter_dict)

        if event.requires_credentials:
            if 'registered' not in request.session:
                return render_to_response('guest/register.html', self.parameter_dict)


        try:
            decision = Decision.objects.get(event=event, published=True)
            self.parameter_dict['decision'] = decision
            message = decision.question_to_be_asked
        except Decision.DoesNotExist:
            decision = None
            message  = "There is nothing to vote on at the current moment"
            self.parameter_dict['notification_type'] = 'danger'
        except Decision.MultipleObjectsReturned:
            self.parameter_dict['notification_type'] = 'danger'
            message =  "More than 1 decision is published error...system error"
            decision = None

        if decision:
            decision_answers = DecisionAnswers.objects.filter(decision = decision)
            self.parameter_dict['decision_answers'] = decision_answers
            if event.venue.low_ip_range == self.parameter_dict['guest_ip']:
                event.number_of_internal_users =+ 1
            else:
                event.number_of_external_users = + 1
            event.save()

            if 'guest_id' not in request.session:
                guest = Guest(first_name="anon", ip=self.parameter_dict['guest_ip'])
                guest.save()
                request.session['guest_id'] = guest.id
        else:
            self.parameter_dict['decision_answers'] = None

        self.parameter_dict['message'] = message
        return render_to_response('guest/vote.html', self.parameter_dict)


def vote(request, da_id):
    decision_answer =  DecisionAnswers.objects.get(id=da_id)
    guest = Guest.objects.get(id=request.session['guest_id'])
    ga = GuestAnswers(guest=guest,decision_answers = decision_answer )
    ga.save()

    message = "Success"
    return HttpResponse(json.dumps(message), content_type='application/json')

@csrf_exempt
def register(request):
    request.session['registered'] = True
    if 'guest_id' not in request.session:
        guest = Guest(first_name=request.POST.get("first_name"), zip=request.POST.get("zip_code"))
        guest.save()
        request.session['guest_id'] = guest.id

    return redirect('guest.views.GuestVote', eid=request.POST.get("event_id"))



def get_client_ip(request):
    x_forwarded_for = request.META.get('HTTP_X_FORWARDED_FOR')
    if x_forwarded_for:
        ip = x_forwarded_for.split(',')[0]
    else:
        ip = request.META.get('REMOTE_ADDR')
    return ip