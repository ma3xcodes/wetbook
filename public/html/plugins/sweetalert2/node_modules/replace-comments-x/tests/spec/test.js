'use strict';

var replaceComments;
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
  replaceComments = require('../../index.js');
} else {
  replaceComments = returnExports;
}

describe('replaceComments', function () {
  it('is a function', function () {
    expect(typeof replaceComments).toBe('function');
  });

  it('should return an empty string when target is not a string', function () {
    expect(replaceComments()).toBe('');
    expect(replaceComments(void 0)).toBe('');
    expect(replaceComments(null)).toBe('');
    expect(replaceComments(1)).toBe('');
    expect(replaceComments(true)).toBe('');
    expect(replaceComments(function () {})).toBe('');
    expect(replaceComments(/ddd/g)).toBe('');
    expect(replaceComments(new Date())).toBe('');
  });

  it('should return an empty string for basic comment matches', function () {
    expect(replaceComments('/* test */')).toBe('');
    expect(replaceComments('/*test*/')).toBe('');
    expect(replaceComments('/** test */')).toBe('');
    expect(replaceComments('/**test*/')).toBe('');
    expect(replaceComments('// test')).toBe('');
    expect(replaceComments('//test')).toBe('');
  });

  it('should return the replacement string for basic comment matches', function () {
    expect(replaceComments('/* test */', 'replaced')).toBe('replaced');
    expect(replaceComments('/*test*/', 'replaced')).toBe('replaced');
    expect(replaceComments('/** test */', 'replaced')).toBe('replaced');
    expect(replaceComments('/**test*/', 'replaced')).toBe('replaced');
    expect(replaceComments('// test', 'replaced')).toBe('replaced');
    expect(replaceComments('//test', 'replaced')).toBe('replaced');
  });

  it('if replacement is not a string should return "" for basic comment matches', function () {
    expect(replaceComments('/* test */'), void 0).toBe('');
    expect(replaceComments('/*test*/'), null).toBe('');
    expect(replaceComments('/** test */', 1)).toBe('');
    expect(replaceComments('/**test*/', true)).toBe('');
    expect(replaceComments('// test', /ddd/)).toBe('');
    expect(replaceComments('//test'), new Date()).toBe('');
  });

  it('should return the correct string for complex comment matches', function () {
    expect(replaceComments('complex;/* test */', ' ')).toBe('complex; ');
    expect(replaceComments('complex; /* test */', ' ')).toBe('complex;  ');
    expect(replaceComments('complex;/*test*/', ' ')).toBe('complex; ');
    expect(replaceComments('complex; /*test*/', ' ')).toBe('complex;  ');
    expect(replaceComments('complex;/** test */', ' ')).toBe('complex; ');
    expect(replaceComments('complex; /** test */', ' ')).toBe('complex;  ');
    expect(replaceComments('complex;/**test*/', ' ')).toBe('complex; ');
    expect(replaceComments('complex; /**test*/', ' ')).toBe('complex;  ');
    expect(replaceComments('complex;// test', ' ')).toBe('complex; ');
    expect(replaceComments('complex; // test', ' ')).toBe('complex;  ');
    expect(replaceComments('complex;//test', ' ')).toBe('complex; ');
    expect(replaceComments('complex; //test', ' ')).toBe('complex;  ');
    expect(replaceComments('function /*1*/complex/*2*(/*3*/)/*4*/{/*5*/}/*6*///test', ' ')).toBe('function  complex ) { }  ');
  });
});
