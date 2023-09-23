var options1 = {
    series: [{
        data: [25, 66, 41, 89, 63, 25, 44, 20, 36, 40, 54]
    }],
    fill: {
        colors: ["#5b73e8"]
    },
    chart: {
        type: "bar",
        width: 70,
        height: 40,
        sparkline: {
            enabled: !0
        }
    },
    plotOptions: {
        bar: {
            columnWidth: "50%"
        }
    },
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
    xaxis: {
        crosshairs: {
            width: 1
        }
    },
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
},
chart1 = new ApexCharts(document.querySelector("#total-revenue-chart"), options1);
chart1.render();
var options = {
    fill: {
        colors: ["#34c38f"]
    },
    series: [70],
    chart: {
        type: "radialBar",
        width: 45,
        height: 45,
        sparkline: {
            enabled: !0
        }
    },
    dataLabels: {
        enabled: !1
    },
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 0,
                size: "60%"
            },
            track: {
                margin: 0
            },
            dataLabels: {
                show: !1
            }
        }
    }
},
chart = new ApexCharts(document.querySelector("#orders-chart"), options);
chart.render();
options = {
fill: {
    colors: ["#5b73e8"]
},
series: [55],
chart: {
    type: "radialBar",
    width: 45,
    height: 45,
    sparkline: {
        enabled: !0
    }
},
dataLabels: {
    enabled: !1
},
plotOptions: {
    radialBar: {
        hollow: {
            margin: 0,
            size: "60%"
        },
        track: {
            margin: 0
        },
        dataLabels: {
            show: !1
        }
    }
}
};
(chart = new ApexCharts(document.querySelector("#customers-chart"), options)).render();
var options2 = {
    series: [{
        data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
    }],
    fill: {
        colors: ["#f1b44c"]
    },
    chart: {
        type: "bar",
        width: 70,
        height: 40,
        sparkline: {
            enabled: !0
        }
    },
    plotOptions: {
        bar: {
            columnWidth: "50%"
        }
    },
    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
    xaxis: {
        crosshairs: {
            width: 1
        }
    },
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function (e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
},
chart2 = new ApexCharts(document.querySelector("#growth-chart"), options2);
chart2.render();
// var responseData;
// $.ajax({
//     url: 'Dashboard/saleAnalysis',
//     type: 'post',
//     dataType: 'json',
//     success:function(responseData) {
//         responseData = responseData;
//     }
// });

options = {
chart: {
    height: 339,
    type: "line",
    stacked: !1,
    toolbar: {
        show: !1
    }
},
stroke: {
    width: [0, 2, 4],
    curve: "smooth"
},
plotOptions: {
    bar: {
        columnWidth: "30%"
    }
},
colors: ["#5b73e8", "#dfe2e6", "#f1b44c"],
series: [{
    name: "Total",
    type: "column",
    data:[22,55,88,44,77,99,99,63,666,33,3,88,88,22,22]
}, {
    name: "Paid",
    type: "area",
    data: [22,55,88,44,77,99,99,63,666,33,3,88,88,22,22]
}, {
    name: "Balance",
    type: "line",
    data: [22,55,88,44,77,99,99,63,666,33,3,88,88,22,22]
}],
fill: {
    opacity: [.85, .25, 1],
    gradient: {
        inverseColors: !1,
        shade: "light",
        type: "vertical",
        opacityFrom: .85,
        opacityTo: .55,
        stops: [0, 100, 100, 100]
    }
},
labels: ['22','55','88','44','77','99','99','63','666','33','3','88','88','22','22'],
markers: {
    size: 0
},
xaxis: {
    type: "datetime"
},
yaxis: {
    title: {
        text: ""
    }
},
tooltip: {
    shared: !0,
    intersect: !1,
    y: {
        formatter: function (e) {
            return void 0 !== e ? e.toFixed(0) + " " : e
        }
    }
},
grid: {
    borderColor: "#f1f1f1"
}
};

(chart = new ApexCharts(document.querySelector("#sales-analytics-chart"), options)).render();