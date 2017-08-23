'use strict';

var normalizeSpace;
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
  normalizeSpace = require('../../index.js');
} else {
  normalizeSpace = returnExports;
}

describe('normalizeSpace', function () {
  it('Basic tests', function () {
    expect(normalizeSpace('a')).toBe('a', 'noop when no whitespace');
    var allWhitespaceChars = '\x09\x0A\x0B\x0C\x0D\x20\xA0\u1680\u180E\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200A\u202F\u205F\u3000\u2028\u2029\uFEFF';
    expect(normalizeSpace(allWhitespaceChars + 'a' + allWhitespaceChars + 'b' + allWhitespaceChars)).toBe('a b', 'all expected whitespace chars are trimmed and normalized');
    var zeroWidth = '\u200b';
    expect(normalizeSpace(zeroWidth)).toBe(zeroWidth, 'zero width space does not normalize');
  });
});
