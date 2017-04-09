soundManager.url = '/swf/';
soundManager.flashVersion = 9;
soundManager.useFlashBlock = false;
soundManager.useHighPerformance = true;
soundManager.wmode = 'transparent';
soundManager.useFastPolling = true;

// Wait for jQuery to load properly

var Player = function(dom,data,key){
	this.dom = dom;
	this.data = data;
	this.key = key;
	if(data.kind == 'playlist')
		this.tracks = data.tracks;
	else if(data.kind == 'track')
		this.tracks = [data]; //Revizar el caso de un solo tema
	this.current = 0;
	this.dom.find('.play').on('click',this.play.bind(this));
	this.init();
}

Player.prototype.play = function(ev) {
	ev.preventDefault();
	ev.stopPropagation();
	var dom = jQuery(ev.target);
	if(!dom.hasClass('playing')){
		soundManager.stopAll();
		soundManager.togglePause(this.tracks[this.current].id);
	}else{
		soundManager.stopAll();
	}
};
Player.prototype.init = function(){
	var self = this;
	this.tracks.forEach(function(track){
		soundManager.createSound({
			id: track.id,
			url: track.stream_url+'?consumer_key='+self.key,
			onplay: function() {
				self.updateCurrent();
				self.dom.find('.play').addClass('playing');
			},
			onresume: function() {
				self.dom.find('.play').addClass('playing');
			},
			onpause: function() {
				self.dom.find('.play').removeClass('playing');
			},
			onstop: function() {
				self.dom.find('.play').removeClass('playing');
			},
			onfinish: function() {
				self.nextTrack();
			}
		});
	})
	this.updateCurrent();
}
Player.prototype.next = function(){
	soundManager.stopAll();
	this.current ++;
	if(this.current >= this.tracks.length) this.current = 0;
	soundManager.play(this.tracks[this.current].id);
}
Player.prototype.back = function(){
	soundManager.stopAll();
	this.current --;
	if(this.current < 0) this.current = this.tracks.length-1;
	soundManager.play(this.tracks[this.current].id);
}
Player.prototype.updateCurrent = function(){
	this.currentTrack = this.tracks[this.current];
}

var discos;

jQuery(function() {
 	discos = function($){
		var key = "124b75747774906242dca32d3a9b9bae";
		var players = [];	
		this.players = players;
		soundManager.onready(function(){
			$(".player").each(function(i,dom){
				console.log(arguments);
				dom = $(dom);
				if(!dom.attr('soundcloud')) {
					dom.remove();
					return;
				}
				$.getJSON('http://api.soundcloud.com/resolve?url=' + dom.attr('soundcloud') + '&format=json&consumer_key=' + key + '&callback=?', function(playlist){	
					players.push(new Player(dom,playlist,key));
				})
			})
		});
	}(jQuery);
});