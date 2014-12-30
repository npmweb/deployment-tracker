var app = app || {};

app.Environment = Backbone.Model.extend({});

app.EnvironmentCollection = Backbone.Collection.extend({
  model: app.Environment,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    }
  },
  url: function() {
    return app.baseUrl
      + '/environments'
      + app.bustCache(false);
  },
  parse: function(response) {
    return response.environments;
  }
});
