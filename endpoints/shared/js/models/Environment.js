var app = app || {};

app.Environment = Backbone.Model.extend({});

app.EnvironmentCollection = Backbone.Collection.extend({
  model: app.Environment,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    } else {
      this.fetch({reset:true});
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
