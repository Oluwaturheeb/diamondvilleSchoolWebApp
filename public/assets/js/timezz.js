!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define("timezz",[],t):"object"==typeof exports?exports.timezz=t():e.timezz=t()}("undefined"==typeof self?this:self,(function(){return(()=>{"use strict";var e={133:(e,t)=>{function n(e){return(n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function o(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}var i="[TimezZ]",r="https://github.com/BrooonS/timezz",s=36e5,a=864e5,c=["days","hours","minutes","seconds"],f=function(){function e(t,n){var o=this;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.checkFields=function(e){var t=function(t,n){if(void 0!==e[t]&&n.length){var r=o.getElements();console.warn("".concat(i,":"),"Parameter '".concat(t,"' should be ").concat(n.length>1?"one of the types":"the type",": ").concat(n.join(", "),"."),r.length>1?r:r[0])}};e.date instanceof Date||"string"==typeof e.date||"number"==typeof e.date||t("date",["Date","string","number"]),"boolean"!=typeof e.stop&&t("stop",["boolean"]),"boolean"!=typeof e.canContinue&&t("canContinue",["boolean"]),"function"!=typeof e.beforeCreate&&t("beforeCreate",["function"]),"function"!=typeof e.beforeDestroy&&t("beforeDestroy",["function"]),"function"!=typeof e.update&&t("update",["function"])},this.fixZero=function(e){return e>=10?"".concat(e):"0".concat(e)},this.fixNumber=function(e){return Math.floor(Math.abs(e))},this.elements=t,this.checkFields(n),this.date=n.date,this.stop=n.stop||!1,this.canContinue=n.canContinue||!1,this.beforeCreate=n.beforeCreate,this.update=n.update,"function"==typeof this.beforeCreate&&this.beforeCreate(),this.init()}var t,n;return t=e,(n=[{key:"init",value:function(){var e=new Date(this.date).getTime()-(new Date).getTime(),t=this.canContinue||e>0,n={days:t?this.fixNumber(e/a):0,hours:t?this.fixNumber(e%a/s):0,minutes:t?this.fixNumber(e%s/6e4):0,seconds:t?this.fixNumber(e%6e4/1e3):0,distance:Math.abs(e)};(t&&!this.stop||!this.timeout)&&this.setHTML(n),"function"==typeof this.update&&this.update(n),this.timeout||(this.timeout=setInterval(this.init.bind(this),1e3))}},{key:"setHTML",value:function(e){var t=this;this.getElements().forEach((function(n){c.forEach((function(o){var i=n.querySelector("[data-".concat(o,"]")),r=t.fixZero(e[o]);i&&i.innerHTML!==r&&(i.innerHTML=r)}))}))}},{key:"getElements",value:function(){var e=[];try{"string"==typeof this.elements?e=Array.from(document.querySelectorAll(this.elements)):(Array.isArray(this.elements)||this.elements instanceof NodeList)&&Array.from(this.elements).every((function(e){return e instanceof HTMLElement}))?e=Array.from(this.elements):this.elements instanceof HTMLElement&&(e=[this.elements])}catch(e){}return e}},{key:"destroy",value:function(){this.timeout&&(clearInterval(this.timeout),this.timeout=null),this.getElements().forEach((function(e){c.forEach((function(t){var n=e.querySelector("[data-".concat(t,"]"));n&&(n.innerHTML="\x3c!-- --\x3e")}))}))}}])&&o(t.prototype,n),e}(),u=function(e,t){if(void 0===e)throw new Error("".concat(i,": Elements isn't passed. Check documentation for more info. ").concat(r));if(!t||"object"!==n(t)||Number.isNaN(new Date(t.date).getTime()))throw new Error("".concat(i,": Date isn't valid. Check documentation for more info. ").concat(r));return new f(e,t)};u.prototype=f.prototype,t.default=u}},t={};return function n(o){if(t[o])return t[o].exports;var i=t[o]={exports:{}};return e[o](i,i.exports,n),i.exports}(133)})().default}));