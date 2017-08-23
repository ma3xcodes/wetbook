'use strict';

var whiteSpace;
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
  whiteSpace = require('../../index.js');
} else {
  whiteSpace = returnExports;
}

var list = [
  {
    code: 0x0009,
    description: 'Tab',
    string: '\u0009'
  },
  {
    code: 0x000a,
    description: 'Line Feed',
    string: '\u000a'
  },
  {
    code: 0x000b,
    description: 'Vertical Tab',
    string: '\u000b'
  },
  {
    code: 0x000c,
    description: 'Form Feed',
    string: '\u000c'
  },
  {
    code: 0x000d,
    description: 'Carriage Return',
    string: '\u000d'
  },
  {
    code: 0x0020,
    description: 'Space',
    string: '\u0020'
  },
  /*
  {
    code: 0x0085,
    description: 'Next line - Not ES5 whitespace',
    string: '\u0085'
  }
  */
  {
    code: 0x00a0,
    description: 'No-break space',
    string: '\u00a0'
  },
  {
    code: 0x1680,
    description: 'Ogham space mark',
    string: '\u1680'
  },
  {
    code: 0x180e,
    description: 'Mongolian vowel separator',
    string: '\u180e'
  },
  {
    code: 0x2000,
    description: 'En quad',
    string: '\u2000'
  },
  {
    code: 0x2001,
    description: 'Em quad',
    string: '\u2001'
  },
  {
    code: 0x2002,
    description: 'En space',
    string: '\u2002'
  },
  {
    code: 0x2003,
    description: 'Em space',
    string: '\u2003'
  },
  {
    code: 0x2004,
    description: 'Three-per-em space',
    string: '\u2004'
  },
  {
    code: 0x2005,
    description: 'Four-per-em space',
    string: '\u2005'
  },
  {
    code: 0x2006,
    description: 'Six-per-em space',
    string: '\u2006'
  },
  {
    code: 0x2007,
    description: 'Figure space',
    string: '\u2007'
  },
  {
    code: 0x2008,
    description: 'Punctuation space',
    string: '\u2008'
  },
  {
    code: 0x2009,
    description: 'Thin space',
    string: '\u2009'
  },
  {
    code: 0x200a,
    description: 'Hair space',
    string: '\u200a'
  },
  /*
  {
    code: 0x200b,
    description: 'Zero width space - Not ES5 whitespace',
    string: '\u200b'
  },
  */
  {
    code: 0x2028,
    description: 'Line separator',
    string: '\u2028'
  },
  {
    code: 0x2029,
    description: 'Paragraph separator',
    string: '\u2029'
  },
  {
    code: 0x202f,
    description: 'Narrow no-break space',
    string: '\u202f'
  },
  {
    code: 0x205f,
    description: 'Medium mathematical space',
    string: '\u205f'
  },
  {
    code: 0x3000,
    description: 'Ideographic space',
    string: '\u3000'
  },
  {
    code: 0xfeff,
    description: 'Byte Order Mark',
    string: '\ufeff'
  }
];

var string = list.reduce(function (acc, item) {
  return acc + String.fromCharCode(item.code);
}, '');

var nonWhiteSpaceStr = new Array(0xfeff).fill().reduce(function (str, u, index) {
  var includes = function _includes(item) {
    return item.code === index;
  };

  return list.some(includes) ? str : str + String.fromCodePoint(index);
}, '');

describe('Basic tests', function () {
  it('should be equal', function () {
    expect(whiteSpace.list).toEqual(list);
    expect(whiteSpace.string).toBe(string);
  });

  it('should be equal', function () {
    var re = new RegExp('[' + whiteSpace.string + ']', 'g');
    expect((string + nonWhiteSpaceStr).replace(re, '')).toBe(nonWhiteSpaceStr);
    expect((nonWhiteSpaceStr + string).replace(re, '')).toBe(nonWhiteSpaceStr);
  });

  it('should be equal', function () {
    var re = new RegExp('[^' + whiteSpace.string + ']', 'g');
    expect((string + nonWhiteSpaceStr).replace(re, '')).toBe(string);
    expect((nonWhiteSpaceStr + string).replace(re, '')).toBe(string);
  });

  it('should be `true`', function () {
    var re = new RegExp('^[' + whiteSpace.string + ']+$');
    expect(re.test(string)).toBe(true);
  });

  it('should be `false`', function () {
    var re = new RegExp('[' + whiteSpace.string + ']');
    expect(re.test(nonWhiteSpaceStr)).toBe(false);
  });

  it('should be `true`', function () {
    var re = new RegExp('^[^' + whiteSpace.string + ']+$');
    expect(re.test(nonWhiteSpaceStr)).toBe(true);
  });

  it('should be `false`', function () {
    var re = new RegExp('[^' + whiteSpace.string + ']');
    expect(re.test(string)).toBe(false);
  });
});
