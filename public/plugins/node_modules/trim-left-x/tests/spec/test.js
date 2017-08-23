'use strict';

var trimLeft;
if (typeof module === 'object' && module.exports) {
  require('es5-shim');
  require('es5-shim/es5-sham');
  if (typeof JSON === 'undefined') {
    JSON = {};
  }
  require('json3').runInContext(null, JSON);
  require('es6-shim');
  var es7 = require('es7-shim');
  Object.keys(es7).forEach(function (key) {
    var obj = es7[key];
    if (typeof obj.shim === 'function') {
      obj.shim();
    }
  });
  trimLeft = require('../../index.js');
} else {
  trimLeft = returnExports;
}

describe('trimLeft', function () {
  it('Basic tests', function () {
    var rest = 'a \t\n';
    expect(trimLeft(' \t\n' + rest)).toBe(rest, 'strips whitespace off the left side');
    expect(trimLeft('a')).toBe('a', 'noop when no whitespace');
    var allWhitespaceChars = '\x09\x0A\x0B\x0C\x0D\x20\xA0\u1680\u180E\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u3000\u2028\u2029\uFEFF';
    rest = 'a' + allWhitespaceChars;
    expect(trimLeft(allWhitespaceChars + rest)).toBe(rest, 'all expected whitespace chars are trimmed');
    var zeroWidth = '\u200b';
    expect(trimLeft(zeroWidth)).toBe(zeroWidth, 'zero width space does not trim');
  });
});
