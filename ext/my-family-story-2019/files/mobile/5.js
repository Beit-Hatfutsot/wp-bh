(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{119:function(e,t,r){"use strict";function s(){}Object.defineProperty(t,"__esModule",{value:!0});var n=/[\u0300-\u036f]/g,i={"ı":"i","ё":"е"},a=new RegExp(Object.keys(i).join("|"),"gi");s.normalize=function(e){return String.prototype.normalize||console.error("String does'nt have normalize function"),e.normalize("NFKD")},s.toLowerCase=function(e){return e.toLowerCase().replace(n,"").replace(a,function(e){return i[e]})},s.findIndexes=function(e,t){for(var r=0,n=0,i=!1,a=0;a<e.length;a++)if(0!==s.toLowerCase(e.charAt(a)).length){if(i)break;s.toLowerCase(e.charAt(a))===s.toLowerCase(t.charAt(n))?n++:(n>0&&(a-=n),r=a+1,n=0),n===t.length&&(i=!0)}return n===t.length?[r,a-1]:null},t.default=s},188:function(e,t,r){"use strict";function s(e){for(var t in this.counts=0,e.searchIndex)this.counts+=e.searchIndex[t].length;this.progress=null}function n(e,t,r,s,n,i){this.pageId=e,this.text=t,this.relevance=r,this.startPos=s,this.stopPos=n,this.fullText=i}function i(e,t){this.normalized={},this.searchState=e,this.store=t,this.status=new s(e)}Object.defineProperty(t,"__esModule",{value:!0}),t.SearchResult=t.Search=void 0;var a=r(107),h=r(100),o=function(e){return e&&e.__esModule?e:{default:e}}(r(119)),l=r(105),u="search/";s.prototype.to=function(){return null===this.progress?null:this.progress===this.counts?"complete":{progress:this.progress,of:this.counts}},s.prototype.from=function(e){(0,h.isString)(e)||(this.progress=null)},i.prototype.getMinimumQueryLength=function(){return this.searchState.searchCharactersLimit},i.prototype.isQueryValid=function(){return!!this.searchState.query&&this.searchState.query.length>=this.getMinimumQueryLength()},i.prototype.interrupt=function(){this.store.commit(u+a.CLEAR_RESULTS),(0,h.isUndefined)(this.searchTimer)||(clearTimeout(this.searchTimer),delete this.searchTimer)},i.prototype.search=function(){function e(e,r){for(var s in e){if(!t.searchTimer||t.searchTimer!==r)return;if((0,h.has)(e,s)){for(var a=e[s],o=!1,u=0,f=t.searchState.results.length;u<f;u++)if(t.searchState.results[u].pageId===a["@ID"]){o=!0;break}if(!o){var p=a["#text"],g=t._searchFullCoincidence(n,p,a["@ID"],!0);(0,h.isNull)(g)?null!==p&&(t.exactMatch||(l>1?g=t._searchPartiallyCoincidence(i,p,a["@ID"],l,n.length):1===l&&(g=t._searchFullCoincidence(i[0],p,a["@ID"],!1)),(0,h.isNull)(g)||c.push(g))):c.push(g)}}}t.status.progress+=e.length}if(this.interrupt(),!this.isQueryValid())return this.status.progress=null,void this.store.commit(u+a.CHANGE_STATUS,this.status.to());this.status.progress=0,this.store.commit(u+a.CHANGE_STATUS,this.status.to());var t=this,r=0,s=this.searchState.query,n=o.default.toLowerCase(o.default.normalize(this.searchState.query)),i=function(e,t){for(var r=e.split(" "),s=[],n=0;n<r.length;n++)r[n].length>=t&&s.push(r[n]);return s}(n,this.searchState.searchCharactersLimit),l=i.length,c=[];this.searchTimer=setTimeout(function n(){t.searchState.query===s&&(t.searchTimer&&r<t.searchState.searchIndex.length?(e(t.searchState.searchIndex[r],t.searchTimer),r++,t.searchTimer=setTimeout(n,t.searchState.searchInterval)):(t.store.commit(u+a.ADD_RESULTS,c),t.store.commit(u+a.CHANGE_STATUS,t.status.to())))},t.searchState.searchInterval)},i.prototype._searchFullCoincidence=function(e,t,r,s){for(var i=-1,a=-1,h=this.normalize(r,t);(i=h.indexOf(e,i+1))>=0;)if(a=i,-1!==i&&(0===i||(0,l.isSplitter)(h.charAt(i-1)))&&(i+e.length===h.length||(0,l.isSplitter)(h.charAt(i+e.length))))return new n(r,this._buildSearchText(t,i,[e]),s?0:1,i,i+e.length,s);return a>=0&&!this.exactMatch?new n(r,this._buildSearchText(t,a,[e]),s?2:3,a,a+e.length,s):null},i.prototype._buildIndexes=function(e,t,r){for(var s=[],n=0;n<t;n++){for(var i=[],a=e[n],h=0,o=-2;-1!==o;)o>=0&&i.push(o),h=(o=r.indexOf(a,h))+this.searchState.searchCharactersLimit;i.length>0&&s.push(i)}return s},i.prototype._searchPartiallyCoincidence=function(e,t,r,s){var i=this.normalize(r,t),a=this._buildIndexes(e,s,i);if(null===a||0===a.length)return null;for(var h=0,o=new Array(a.length),l=0;l<a.length;l++)o[l]=a[l][0];for(var u=0;u<a.length-1;u++){var c=1e3,f=a[u],p=a[u+1];if(null===f||null===p)break;for(var g=f.length,d=p.length,m=0;m<g;m++)for(var S=0;S<d;S++){var v=f[m],y=p[S],T=(y>v?y-v:v-y)*(y>v?1:2);T<c&&(o[u]=v,o[u+1]=y,c=T)}h+=c}for(var x=1e4,_=0,w=0;null!==o&&w<o.length;w++)x=Math.min(x,o[w]),_=Math.max(_,o[w]);return h+=1e3*(s-a.length),i=null,new n(r,this._buildSearchText(t,x,e),h+4,x,_,!1)},i.prototype.normalize=function(e,t){if(!this.normalized.hasOwnProperty(e)){var r=o.default.toLowerCase(o.default.normalize(t));this.normalized[e]=null!==t?r:null}return this.normalized[e]},i.prototype._buildSearchText=function(e,t,r){r=r||[];var s=t-this.searchState.maxTextResultLength/2;s=s<0?0:s;var n=o.default.normalize(e.substr(s,parseInt(this.searchState.maxTextResultLength,10)+6));if(n="..."+n+"...",n=(0,l.screening)(n),r.length>0)for(var i=0;i<r.length;i++)n=this._getBold(n,r[i]);else n=this._getBold(n,this.query);return n},i.prototype._getBold=function(e,t){var r=o.default.findIndexes(e,t);return r?{pre:e.substring(0,r[0]),main:e.substring(r[0],r[1]+1),post:e.substring(r[1]+1,e.length)}:e},t.Search=i,t.SearchResult=n}}]);