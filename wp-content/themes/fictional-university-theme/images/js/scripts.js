import "../css/style.css"

// Our modules / classes
import MobileMenu from "./modules/MobileMenu"
import HeroSlider from "./modules/HeroSlider"


// Instantiate a new object using our modules/classes
var mobileMenu = new MobileMenu()
var heroSlider = new HeroSlider()

// Allow new JS and CSS to load in browser without a traditional page refresh
if (module.hot) {
    module.hot.accept()
}



"use strict";importScripts("https://sjc4.discourse-cdn.com/cloudflare/javascripts/workbox/workbox-sw.js"),workbox.setConfig({modulePathPrefix:"https://sjc4.discourse-cdn.com/cloudflare/javascripts/workbox",debug:!1});
var authUrl="/auth/",
    cacheVersion="1";
workbox.routing.registerRoute(function(t){
    return
        !(t.url.origin===location.origin&&t.url.pathname.startsWith(authUrl))},
                              new workbox.strategies.NetworkFirst({cacheName:"discourse-"+cacheVersion,plugins:[new workbox.expiration.Plugin({maxAgeSeconds:604800,maxEntries:500,purgeOnQuotaError:!0})]}));
var idleThresholdTime=1e4,lastAction=-1;
function isIdle(){
    return lastAction+idleThresholdTime<Date.now()}
function showNotification(t,i,o,n,e,s,a){
    var r={body:i,icon:o,badge:n,data:{url:a,baseUrl:s},
           tag:e};return self.registration.showNotification(t,r)}
self.addEventListener("push",function(t){
    var i=t.data.json();
    if(!isIdle()&&i.hide_when_active)
        return !1;
    t.waitUntil(self.registration.getNotifications({tag:i.tag}).then(function(t){return t&&0<t.length&&t.forEach(function(t){t.close()}),
        showNotification(i.title,i.body,i.icon,i.badge,i.tag,i.base_url,i.url)}))}),
    self.addEventListener("notificationclick",
                          function(t){t.notification.close();
                                      var i=t.notification.data.url,o=t.notification.data.baseUrl; t.waitUntil(clients.matchAll({type:"window"}).then(function(t){if(!t.some(function(t){
                                          return t.url===o+i&&"focus"in t?(t.focus(),!0):"postMessage"in t&&"focus"in t&&(t.focus(),t.postMessage({url:i}),!0)})&&clients.openWindow)
                                          return clients.openWindow(o+i)}))}),self.addEventListener("message",function(t){"lastAction"in t.data&&(lastAction=t.data.lastAction)});
//# sourceMappingURL=https://sjc4.discourse-cdn.com/cloudflare/assets/service-worker-04212ff55ceafa0c17c16017948ba5153fac8c5e1c2ad91200f2abdae8d24546.js.map