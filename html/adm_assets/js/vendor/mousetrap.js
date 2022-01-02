!function(e,t,n){if(e){for(var r,i={8:"backspace",9:"tab",13:"enter",16:"shift",17:"ctrl",18:"alt",20:"capslock",27:"esc",32:"space",33:"pageup",34:"pagedown",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"ins",46:"del",91:"meta",93:"meta",224:"meta"},o={106:"*",107:"+",109:"-",110:".",111:"/",186:";",187:"=",188:",",189:"-",190:".",191:"/",192:"`",219:"[",220:"\\",221:"]",222:"'"},a={"~":"`","!":"1","@":"2","#":"3",$:"4","%":"5","^":"6","&":"7","*":"8","(":"9",")":"0",_:"-","+":"=",":":";",'"':"'","<":",",">":".","?":"/","|":"\\"},c={option:"alt",command:"meta",return:"enter",escape:"esc",plus:"+",mod:/Mac|iPod|iPhone|iPad/.test(navigator.platform)?"meta":"ctrl"},s=1;s<20;++s)i[111+s]="f"+s;for(s=0;s<=9;++s)i[s+96]=s.toString();d.prototype.bind=function(e,t,n){return e=e instanceof Array?e:[e],this._bindMultiple.call(this,e,t,n),this},d.prototype.unbind=function(e,t){return this.bind.call(this,e,(function(){}),t)},d.prototype.trigger=function(e,t){return this._directMap[e+":"+t]&&this._directMap[e+":"+t]({},e),this},d.prototype.reset=function(){return this._callbacks={},this._directMap={},this},d.prototype.stopCallback=function(e,n){return!((" "+n.className+" ").indexOf(" mousetrap ")>-1)&&(!function e(n,r){return null!==n&&n!==t&&(n===r||e(n.parentNode,r))}(n,this.target)&&("INPUT"==n.tagName||"SELECT"==n.tagName||"TEXTAREA"==n.tagName||n.isContentEditable))},d.prototype.handleKey=function(){var e=this;return e._handleKey.apply(e,arguments)},d.addKeycodes=function(e){for(var t in e)e.hasOwnProperty(t)&&(i[t]=e[t]);r=null},d.init=function(){var e=d(t);for(var n in e)"_"!==n.charAt(0)&&(d[n]=function(t){return function(){return e[t].apply(e,arguments)}}(n))},d.init(),e.Mousetrap=d,"undefined"!=typeof module&&module.exports&&(module.exports=d),"function"==typeof define&&define.amd&&define((function(){return d}))}function l(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent("on"+t,n)}function u(e){if("keypress"==e.type){var t=String.fromCharCode(e.which);return e.shiftKey||(t=t.toLowerCase()),t}return i[e.which]?i[e.which]:o[e.which]?o[e.which]:String.fromCharCode(e.which).toLowerCase()}function f(e){return"shift"==e||"ctrl"==e||"alt"==e||"meta"==e}function p(e,t,n){return n||(n=function(){if(!r)for(var e in r={},i)e>95&&e<112||i.hasOwnProperty(e)&&(r[i[e]]=e);return r}()[e]?"keydown":"keypress"),"keypress"==n&&t.length&&(n="keydown"),n}function h(e,t){var n,r,i,o=[];for(n=function(e){return"+"===e?["+"]:(e=e.replace(/\+{2}/g,"+plus")).split("+")}(e),i=0;i<n.length;++i)r=n[i],c[r]&&(r=c[r]),t&&"keypress"!=t&&a[r]&&(r=a[r],o.push("shift")),f(r)&&o.push(r);return{key:r,modifiers:o,action:t=p(r,o,t)}}function d(e){var n=this;if(e=e||t,!(n instanceof d))return new d(e);n.target=e,n._callbacks={},n._directMap={};var r,i={},o=!1,a=!1,c=!1;function s(e){e=e||{};var t,n=!1;for(t in i)e[t]?n=!0:i[t]=0;n||(c=!1)}function p(e,t,r,o,a,c){var s,l,u,p,h=[],d=r.type;if(!n._callbacks[e])return[];for("keyup"==d&&f(e)&&(t=[e]),s=0;s<n._callbacks[e].length;++s)if(l=n._callbacks[e][s],(o||!l.seq||i[l.seq]==l.level)&&d==l.action&&("keypress"==d&&!r.metaKey&&!r.ctrlKey||(u=t,p=l.modifiers,u.sort().join(",")===p.sort().join(",")))){var y=!o&&l.combo==a,m=o&&l.seq==o&&l.level==c;(y||m)&&n._callbacks[e].splice(s,1),h.push(l)}return h}function y(e,t,r,i){n.stopCallback(t,t.target||t.srcElement,r,i)||!1===e(t,r)&&(function(e){e.preventDefault?e.preventDefault():e.returnValue=!1}(t),function(e){e.stopPropagation?e.stopPropagation():e.cancelBubble=!0}(t))}function m(e){"number"!=typeof e.which&&(e.which=e.keyCode);var t=u(e);t&&("keyup"!=e.type||o!==t?n.handleKey(t,function(e){var t=[];return e.shiftKey&&t.push("shift"),e.altKey&&t.push("alt"),e.ctrlKey&&t.push("ctrl"),e.metaKey&&t.push("meta"),t}(e),e):o=!1)}function k(e,t,n,a){function l(t){return function(){c=t,++i[e],clearTimeout(r),r=setTimeout(s,1e3)}}function f(t){y(n,t,e),"keyup"!==a&&(o=u(t)),setTimeout(s,10)}i[e]=0;for(var p=0;p<t.length;++p){var d=p+1===t.length?f:l(a||h(t[p+1]).action);v(t[p],d,a,e,p)}}function v(e,t,r,i,o){n._directMap[e+":"+r]=t;var a,c=(e=e.replace(/\s+/g," ")).split(" ");c.length>1?k(e,c,t,r):(a=h(e,r),n._callbacks[a.key]=n._callbacks[a.key]||[],p(a.key,a.modifiers,{type:a.action},i,e,o),n._callbacks[a.key][i?"unshift":"push"]({callback:t,modifiers:a.modifiers,action:a.action,seq:i,level:o,combo:e}))}n._handleKey=function(e,t,n){var r,i=p(e,t,n),o={},l=0,u=!1;for(r=0;r<i.length;++r)i[r].seq&&(l=Math.max(l,i[r].level));for(r=0;r<i.length;++r)if(i[r].seq){if(i[r].level!=l)continue;u=!0,o[i[r].seq]=1,y(i[r].callback,n,i[r].combo,i[r].seq)}else u||y(i[r].callback,n,i[r].combo);var h="keypress"==n.type&&a;n.type!=c||f(e)||h||s(o),a=u&&"keydown"==n.type},n._bindMultiple=function(e,t,n){for(var r=0;r<e.length;++r)v(e[r],t,n)},l(e,"keypress",m),l(e,"keydown",m),l(e,"keyup",m)}}("undefined"!=typeof window?window:null,"undefined"!=typeof window?document:null);