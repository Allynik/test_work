/* eslint-env node -- webpack is node env */
/* eslint max-len: "off", "compat/compat": "off" -- webpack is node env */

const fs = require('fs');
const path = require('path');
const glob = require('glob');
const beautify = require('js-beautify');
const config = require('./.beautifyrc.json');

const options = {
    ...config,
    templating: 'php',
};

function stripBom(string) {
    if (string.charCodeAt(0) === 0xFEFF) {
        return string.slice(1);
    }
    return string;
}

[
    './mail/**/*.php',
    './modules/*/views/**/*.php',
    './views/**/*.php',
].forEach((i) => glob(i, {
    nodir: true,
}, (error, files) => {
    if (error) throw error;

    files.forEach((resourcePath) => {
        const relativePath = path.relative(__dirname, resourcePath);
        const html = fs.readFileSync(resourcePath).toString('utf-8');

        let output = beautify.html(html.normalize('NFC'), options);

        output = stripBom(output)
            .replace(/\r\n/g, '\n')
            .replace(/\t/g, '    ')
            .replace(/[ \t]+\n/g, '\n');

        output = output.replace(/<\?(?!(php|=|\s))/g, '<?php $1');
        output = output.replace(/<\?=(\S)/g, '<?= $1');
        output = output.replace(/(\S)\?>/g, '$1 ?>');

        if (html !== output) {
            fs.writeFileSync(resourcePath, output);
            console.log(`fixed ${relativePath}`);
        } else {
            console.log(`skipped ${relativePath}`);
        }
    });
}));