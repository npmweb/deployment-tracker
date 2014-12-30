var app = app || {};

app.Server = Backbone.Model.extend({});

app.ServerCollection = Backbone.Collection.extend({
  model: app.Server,
  initialize: function( param ) {
    if( _.isArray(param) ) {
      this.parse({models:param});
    } else {
      this.fetch({reset:true});
    }
  },
  url: function() {
    return app.baseUrl
      + '/servers?'
      + app.bustCache(true);
  },
  parse: function(response) {
    return response.servers;
  }
});
