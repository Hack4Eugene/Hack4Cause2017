import React from 'react';
import Conversation from 'chat-template/dist/Conversation';

var messages = [{
  message:'How do I use this messaging app?',
  from: 'right',
  backColor: '#3d83fa',
  textColor: "white",
  avatar: 'https://www.seeklogo.net/wp-content/uploads/2015/09/google-plus-new-icon-logo.png',
  duration: 2000,
}];

const MyAwesomeConversation = () =>  
  <Conversation height={300} messages={messages}/>