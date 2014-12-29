var app = app || {};

app.bustCache = function(alreadyInQueryString) {
  var string;
  if( alreadyInQueryString ) {
    string = '&';
  } else {
    string = '?';
  }
  return string+'bustcache='+(new Date()).getTime();
};
