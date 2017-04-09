var express = require('express');
var path = require('path');
var orm = require('orm');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var src = require('./index');
const config = require('./config.json');

// var routes = require('./routes/index');
// var users = require('./routes/users');

var app = express();

app.use(orm.express(config.url, {
  define: function (db, models, next) {
    models.Users = db.define("users", {
      user_id: {type: "serial", key: true},
      username: String,
      password: String,
      is_active: Boolean,
      salt: String,
      email: String,
      first_name: String,
      last_name: String,
      address: String,
      phone_home: String,
      phone_cell: String,
      type_id: {type: "serial", unique: false}
    }, {
        methods: {
          fullName: function () {
            return this.first_name + ' ' + this.last_name;
          }
        }
    });

    models.Roles = db.define("roles", {
      type_id: {type: "serial", key: true},
      type: String
    });

    models.Parents = db.define("parents", {
      user_id: {type: "serial"},
      worker_id: {type: "serial"},
      ssn: String,
      birth_date: Date,
      birthplace: String,
      nationality: String,
      height_ft: {type: "integer"},
      height_in: {type: "integer"},
      stature: String,
      hair_color: String,
      eye_color: String,
      skin_color: String,
      prefer_sex: String,
      prefer_age: String,
      prefer_sib_group_size: String,
      prefer_sib_group_gender: String,
      prefer_religion: String,
      bio: String,
      prev_foster: String,
      investigation: String,
      inv_date: Date,
      inv_reason: String,
      inv_outcome: String,
      med_gen_condition: String,
      med_last_exam: Date,
      meds: String,
      safe_assess: String,
      fam_checklist: String,
      ann_income: {type: "integer"},
      month_expenses: {type: "integer"},
      ref_name: String,
      ref_addr: String,
      ref_phone: String,
      ref_email: String
    });

    next();
  }
}));

app.use('/', src);

app.set('port', process.env.PORT || 9000);

var server = app.listen(app.get('port'), function () {
  console.log("App started");
});

// view engine setup
// app.set('views', path.join(__dirname, 'views'));
// app.set('view engine', 'ejs');

app.set('views', __dirname + '/views');
app.set('view engine', 'jsx');
app.engine('jsx', require('express-react-views').createEngine());

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

// app.use('/users', users);
var foo = function () {
  // do something
}

// register new users and add to database
app.post('/api/register', function (req, res) {
  console.log("Registering user!");

  console.log(req.body.username);

  
});

// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handlers

// development error handler
// will print stacktrace
if (app.get('env') === 'development') {
  app.use(function(err, req, res, next) {
    res.status(err.status || 500);
    res.render('error', {
      message: err.message,
      error: err
    });
  });
}

// production error handler
// no stacktraces leaked to user
app.use(function(err, req, res, next) {
  res.status(err.status || 500);
  res.render('error', {
    message: err.message,
    error: {}
  });
});


module.exports = app;
