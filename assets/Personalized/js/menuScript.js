$(document).ready(function () {
  
                    var superuser = [{
                        "text":"Usuarios",
                        "href":"",
                        "target":"_top",
                        "title":"Users",
                        "children":[
                          {
                            "text":"Agregar usuario",
                            "href":"",
                            "target":"_self",
                            "title":""
                          },
                            {
                              "text":"Lista de usuarios",
                              "href":"",
                              "icon":"fa fa-cloud-upload",
                              "target":"_self",
                              "title":""
                          }
                        ]
                      },
                      {
                        "text":"Empresas",
                        "href":"",
                        "icon":"fa fa-crop",
                        "target":"_self",
                        "title":"",
                        "children":[
                          {
                            "text":"Agregar empresa",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Lista de empresas",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      },
                      {
                        "text":"Facturas",
                        "href":"",
                        "icon":"fa fa-flask",
                        "target":"_self",
                        "title":"",
                        "children":[
                          {
                            "text":"Aprobar Pagos",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      },
                      {
                        "text":"Reportes",
                        "href":"",
                        "icon":"fa fa-search",
                        "target":"_self","title":"",
                        "children":[
                          {
                            "text":"Ingresos",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Egresos",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      },
                      {
                        "text":"Inventario",
                        "href":"",
                        "icon":"fa fa-search",
                        "target":"_self","title":""
                      }
                      ];

          // menu for normal user
                var adminuser = [{
                        "text":"Inventario",
                        "href":"",
                        "target":"_top",
                        "title":"Users",
                        "children":[
                          {
                            "text":"Productos",
                            "href":"",
                            "icon":"fa fa-bar-chart-o",
                            "target":"_self",
                            "title":""
                          },
                            {
                              "text":"Material Oficina",
                              "href":"",
                              "icon":"fa fa-cloud-upload",
                              "target":"_self",
                              "title":""
                          }
                        ]
                      },
                      {
                        "text":"Obras / Clientes",
                        "href":"",
                        "icon":"fa fa-crop",
                        "target":"_self",
                        "title":"",
                        "children":[
                          {
                            "text":"Lista Obras/Clientes",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      },
                      {
                        "text":"Ventas",
                        "href":"",
                        "icon":"fa fa-flask",
                        "target":"_self",
                        "title":"",
                        "children":[
                          {
                            "text":"Movimientos (Pagos)",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Anticipos",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Pagos SFV",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Cotizaciones",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Recibo de entrega",
                            "href":"",
                            "icon":"fa fa-cloud-upload",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      },
                      {
                        "text":"Catálogos",
                        "href":"",
                        "icon":"fa fa-search",
                        "target":"_self","title":"",
                        "children":[
                          {
                            "text":"Proveedores",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Productos",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Clientes",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      },
                      {
                        "text":"Flujo de Efectivo",
                        "href":"",
                        "icon":"fa fa-search",
                        "target":"_self","title":"",
                        "children":[
                          {
                            "text":"Proveedores",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      },
                      {
                        "text":"Gastos",
                        "href":"",
                        "icon":"fa fa-search",
                        "target":"_self","title":"",
                        "children":[
                          {
                            "text":"Ventas(Facturas)",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Operativos",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Caja Chica",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Gastos",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          },
                          {
                            "text":"Viaticos",
                            "href":"",
                            "icon":"fa fa-plug",
                            "target":"_self",
                            "title":""
                          }
                        ]
                      }
                      ];
                $('#Super').renderizeMenu(superuser, {
                    active: "nestedSelect.html",
                    rootClass: "nav navbar-nav mr-auto",
                    itemClass: 'nav-item',
                    linkClass: 'nav-link',
                    itemHasMenuClass: "nav-item dropdown",
                    linkHasMenuClass: "nav-link dropdown-toggle",
                    menuClass: "dropdown-menu",
                    menuLinkClass: "dropdown-item",
                    menuItemHasSubmenuClass: "dropdown",
                    menuLinkHasSubmenuClass: "dropdown-item dropdown-toggle",
                    submenuClass: "dropdown-menu",
                });

                $('#Admin').renderizeMenu(adminuser, {
                    active: "nestedSelect.html",
                    rootClass: "nav navbar-nav mr-auto",
                    itemClass: 'nav-item',
                    linkClass: 'nav-link',
                    itemHasMenuClass: "nav-item dropdown",
                    linkHasMenuClass: "nav-link dropdown-toggle",
                    menuClass: "dropdown-menu",
                    menuLinkClass: "dropdown-item",
                    menuItemHasSubmenuClass: "dropdown",
                    menuLinkHasSubmenuClass: "dropdown-item dropdown-toggle",
                    submenuClass: "dropdown-menu",
                });

                jQuery.SmartMenus.Bootstrap.init();

                $('#DASA').removeClass("bg-dark").addClass("bg-dasa");
                $('#ILUMINACION').removeClass("bg-dark").addClass("bg-isa");
                $('#Salinas').removeClass("bg-dark").addClass("bg-dasa");
            
            });