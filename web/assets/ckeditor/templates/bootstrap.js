/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.addTemplates("default", {
    imagesPath: CKEDITOR.getUrl('templates/bootstrap/'),
    templates: [
        { title: "25% 25% 25% 25%", image: "w25w25w25w25.png", description: "", html: '<div class="row"><div class="col-3">25%</div><div class="col-3">25%</div><div class="col-3">25%</div><div class="col-3">25%</div></div>' },
        { title: "25% 25% 50%", image: "w25w25w50.png", description: "", html: '<div class="row"><div class="col-3">25%</div><div class="col-3">25%</div><div class="col-6">50%</div></div>' },
        { title: "25% 50% 25%", image: "w25w50w25.png", description: "", html: '<div class="row"><div class="col-3">25%</div><div class="col-6">50%</div><div class="col-3">25%</div></div>' },
        { title: "33% 67%", image: "w33w67.png", description: "",  html: '<div class="row"><div class="col-4">33%</div><div class="col-8">25%</div></div>' },
        { title: "50% 25% 25%", image: "w50w25w25.png", description: "", html: '<div class="row"><div class="col-6">50%</div><div class="col-3">25%</div><div class="col-3">25%</div></div>' },
        { title: "50% 50%", image: "w50w50.png", description: "", html: '<div class="row"><div class="col-6">50%</div><div class="col-6">50%</div></div>' },
        { title: "67% 33%", image: "w67w33.png", description: "", html: '<div class="row"><div class="col-8">67%</div><div class="col-4">33%</div></div>' }
    ]
});