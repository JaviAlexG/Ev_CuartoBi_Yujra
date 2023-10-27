/*
 Highcharts JS v11.1.0 (2023-06-05)

 Arc diagram module

 (c) 2021 Piotr Madej

 License: www.highcharts.com/license
*/
'use strict';(function(b){"object"===typeof module&&module.exports?(b["default"]=b,module.exports=b):"function"===typeof define&&define.amd?define("highcharts/modules/arc-diagram",["highcharts","highcharts/modules/sankey"],function(p){b(p);b.Highcharts=p;return b}):b("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(b){function p(b,k,q,r){b.hasOwnProperty(k)||(b[k]=r.apply(null,q),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:k,
module:b[k]}})))}b=b?b._modules:{};p(b,"Series/ArcDiagram/ArcDiagramPoint.js",[b["Series/NodesComposition.js"],b["Core/Series/SeriesRegistry.js"],b["Core/Utilities.js"]],function(b,k,q){({seriesTypes:{sankey:{prototype:{pointClass:k}}}}=k);({extend:q}=q);class r extends k{constructor(){super(...arguments);this.toNode=this.shapeArgs=this.scale=this.series=this.options=this.linksTo=this.linksFrom=this.index=this.fromNode=void 0}isValid(){return!0}}q(r.prototype,{setState:b.setNodeState});return r});
p(b,"Series/ArcDiagram/ArcDiagramSeries.js",[b["Series/ArcDiagram/ArcDiagramPoint.js"],b["Series/Sankey/SankeyColumnComposition.js"],b["Core/Series/Series.js"],b["Core/Series/SeriesRegistry.js"],b["Core/Renderer/SVG/SVGRenderer.js"],b["Core/Utilities.js"]],function(b,k,q,r,p,y){var z=this&&this.__rest||function(a,b){var c={},d;for(d in a)Object.prototype.hasOwnProperty.call(a,d)&&0>b.indexOf(d)&&(c[d]=a[d]);if(null!=a&&"function"===typeof Object.getOwnPropertySymbols){var g=0;for(d=Object.getOwnPropertySymbols(a);g<
d.length;g++)0>b.indexOf(d[g])&&Object.prototype.propertyIsEnumerable.call(a,d[g])&&(c[d[g]]=a[d[g]])}return c};const {prototype:{symbols:A}}=p,{seriesTypes:{column:w,sankey:u}}=r,{extend:B,merge:x,pick:v,relativeLength:C}=y;class t extends u{constructor(){super(...arguments);this.points=this.nodes=this.nodeColumns=this.options=this.data=void 0}createNodeColumns(){const a=this,g=a.chart,c=k.compose([],a);c.sankeyColumn.maxLength=g.inverted?g.plotHeight:g.plotWidth;c.sankeyColumn.getTranslationFactor=
a=>{const d=c.slice(),b=this.options.minLinkWidth||0;let e=0,m,h,n=0,f=1,k=0,p=(g.plotSizeX||0)-(a.options.marker&&a.options.marker.lineWidth||0)-(c.length-1)*a.nodePadding;for(;c.length;){e=p/c.sankeyColumn.sum();a=!1;for(m=c.length;m--;){h=c[m].getSum()*e*f;let d=Math.min(g.plotHeight,g.plotWidth);h>d?f=Math.min(d/h,f):h<b&&(c.splice(m,1),p-=b,h=b,a=!0);k+=h*(1-f)/2;n=Math.max(n,h)}if(!a)break}c.length=0;d.forEach(a=>{a.scale=f;c.push(a)});c.sankeyColumn.maxRadius=n;c.sankeyColumn.scale=f;c.sankeyColumn.additionalSpace=
k;return e};c.sankeyColumn.offset=function(d,b){const l=d.series.options.equalNodes;let e=c.sankeyColumn.additionalSpace||0;let m=a.nodePadding,h=Math.min(g.plotWidth,g.plotHeight,(c.sankeyColumn.maxLength||0)/a.nodes.length-m);for(let g=0;g<c.length;g++){var n=c[g].getSum()*(c.sankeyColumn.scale||0);const f=l?h:Math.max(n*b,a.options.minLinkWidth||0);n=n?f+m:0;if(c[g]===d)return{relativeLeft:e+C(d.options.offset||0,n)};e+=n}};a.nodes.forEach(function(a){a.column=0;c.push(a)});return[c]}translateLink(a){const b=
a.fromNode;var c=a.toNode;const d=this.chart,k=this.translationFactor;var l=this.options;const e=v(a.options.linkWeight,l.linkWeight,Math.max((a.weight||0)*k*b.scale,this.options.minLinkWidth||0)),m=a.series.options.centeredLinks;var h=b.nodeY;const n=(c,b)=>{b=(c.offset(a,b)||0)*k;return Math.min(c.nodeX+b,c.nodeX+(c.shapeArgs&&c.shapeArgs.height||0)-e)};let f=m?b.nodeX+((b.shapeArgs.height||0)-e)/2:n(b,"linksFrom");c=m?c.nodeX+((c.shapeArgs.height||0)-e)/2:n(c,"linksTo");f>c&&([f,c]=[c,f]);l.reversed&&
([f,c]=[c,f],h=(d.plotSizeY||0)-h);a.shapeType="path";a.linkBase=[f,f+e,c,c+e];l=(c+e-f)/Math.abs(c+e-f)*v(l.linkRadius,Math.min(Math.abs(c+e-f)/2,b.nodeY-Math.abs(e)));a.shapeArgs={d:[["M",f,h],["A",(c+e-f)/2,l,0,0,1,c+e,h],["L",c,h],["A",(c-f-e)/2,l-e,0,0,0,f+e,h],["Z"]]};a.dlBox={x:f+(c-f)/2,y:h-l,height:e,width:0};a.tooltipPos=d.inverted?[(d.plotSizeY||0)-a.dlBox.y-e/2,(d.plotSizeX||0)-a.dlBox.x]:[a.dlBox.x,a.dlBox.y+e/2];a.y=a.plotY=1;a.x=a.plotX=1;a.color||(a.color=b.color)}translateNode(a,
b){var c=this.translationFactor;const d=this.chart,g=this.options;var l=Math.min(d.plotWidth,d.plotHeight,(d.inverted?d.plotWidth:d.plotHeight)/a.series.nodes.length-this.nodePadding),e=a.getSum()*(b.sankeyColumn.scale||0);l=g.equalNodes?l:Math.max(e*c,this.options.minLinkWidth||0);var m=Math.round(g.marker&&g.marker.lineWidth||0)%2/2,h=b.sankeyColumn.offset(a,c);c=Math.floor(v(h&&h.absoluteLeft,(b.sankeyColumn.left(c)||0)+(h&&h.relativeLeft||0)))+m;const k=x(g.marker,a.options.marker);h=k.symbol;
const f=k.radius;b=parseInt(g.offset,10)*((d.inverted?d.plotWidth:d.plotHeight)-(Math.floor(this.colDistance*(a.column||0)+(k.lineWidth||0)/2)+m+(b.sankeyColumn.scale||0)*(b.sankeyColumn.maxRadius||0)/2))/100;(a.sum=e)?(a.nodeX=c,a.nodeY=b,e=a.options.width||g.width||l,l=a.options.height||g.height||l,m=b,g.reversed&&(m=(d.plotSizeY||0)-b,d.inverted&&(m=(d.plotSizeY||0)-b)),this.mapOptionsToLevel&&(a.dlOptions=u.getDLOptions({level:this.mapOptionsToLevel[a.level],optionsPoint:a.options})),a.plotX=
1,a.plotY=1,a.tooltipPos=d.inverted?[(d.plotSizeY||0)-m-l/2,(d.plotSizeX||0)-c-e/2]:[c+e/2,m+l/2],a.shapeType="path",a.shapeArgs={d:A[h||"circle"](c,m-(f||l)/2,f||e,f||l),width:f||e,height:f||l},a.dlBox={x:c+e/2,y:m,height:0,width:0}):a.dlOptions={enabled:!1}}drawDataLabels(){if(this.options.dataLabels){const a=this.options.dataLabels.textPath;w.prototype.drawDataLabels.call(this,this.nodes);this.options.dataLabels.textPath=this.options.dataLabels.linkTextPath;w.prototype.drawDataLabels.call(this,
this.data);this.options.dataLabels.textPath=a}}pointAttribs(a,b){if(a&&a.isNode){const a=q.prototype.pointAttribs.apply(this,arguments);return z(a,["opacity"])}return super.pointAttribs.apply(this,arguments)}markerAttribs(a){return a.isNode?super.markerAttribs.apply(this,arguments):{}}}t.defaultOptions=x(u.defaultOptions,{centeredLinks:!1,offset:"100%",equalNodes:!1,reversed:!1,dataLabels:{linkTextPath:{attributes:{startOffset:"25%"}}},marker:{symbol:"circle",fillOpacity:1,lineWidth:0,states:{}}});
B(t.prototype,{orderNodes:!1});t.prototype.pointClass=b;r.registerSeriesType("arcdiagram",t);"";return t});p(b,"masters/modules/arc-diagram.src.js",[],function(){})});
//# sourceMappingURL=arc-diagram.js.map