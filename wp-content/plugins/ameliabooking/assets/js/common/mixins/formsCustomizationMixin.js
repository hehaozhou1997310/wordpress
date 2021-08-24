export default {
  data () {
    return {
      defaultFormsData: {
        stepByStepForm: {
          selectServiceForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052',
              formInputColor: '#ffffff',
              formInputTextColor: '#354052',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              serviceHeadingFormField: {
                labels: {
                  please_select_service: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              }
            },
            itemsDraggable: {
              serviceFormField: {
                labels: {
                  service: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              },
              servicePackageFormField: {
                labels: {
                  package_available: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  package_discount_text: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              locationFormField: {
                labels: {
                  locations: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true,
                required: false
              },
              employeeFormField: {
                labels: {
                  employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  any_employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true,
                required: false,
                anyEmployeeVisible: true
              },
              bringingFormField: {
                labels: {
                  bringing_anyone_with_you: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  number_of_additional_persons: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              },
              addExtraFormField: {
                labels: {
                  add_extra: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  extra_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  qty_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  duration_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  price_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              }
            }
          },
          calendarDateTimeForm: {
            globalSettings: {
              formTextColor: '#ffffff',
              formGradientColor1: '#1A84EE',
              formGradientColor2: '#0454A2',
              formGradientAngle: 135
            },
            itemsStatic: {
              timeZoneFormField: {
                visibility: false
              },
              calendarHeadingFormField: {
                labels: {
                  pick_date_and_time: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              calendarAppointmentFormField: {
                endDateVisibility: true
              },
              recurringSwitchFormField: {
                labels: {
                  recurring_active: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              }
            }
          },
          recurringSetupForm: {
            globalSettings: {
              formTextColor: '#ffffff',
              formGradientColor1: '#1A84EE',
              formGradientColor2: '#0454A2',
              formGradientAngle: 135,
              formInputColor: 'rgba(0, 0, 0, 0)',
              formInputTextColor: '#ffffff',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              recurringSetupHeadingFormField: {
                labels: {
                  recurring_active: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              recurringSettingsFormField: {
                labels: {
                  recurring_repeat: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_every: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_on: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_until: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_times: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          recurringDatesForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052',
              formInputColor: '#ffffff',
              formInputTextColor: '#354052',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              recurringDatesHeadingFormField: {
                labels: {
                  recurring_appointments: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_edit: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              recurringInfoFormField: {
                labels: {
                  date: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  time: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          selectPackageForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052',
              formInputColor: '#ffffff',
              formInputTextColor: '#354052',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              packageHeadingFormField: {
                labels: {
                  please_select_package: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              packageFormField: {
                labels: {
                  package_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          packageInfoForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052'
            },
            itemsStatic: {
              packageInfoFormField: {
                labels: {
                  package_discount_text: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  employees: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          packageSetupForm: {
            globalSettings: {
              formTextColor: '#ffffff',
              formGradientColor1: '#1A84EE',
              formGradientColor2: '#0454A2',
              formGradientAngle: 135,
              formInputColor: 'rgba(0, 0, 0, 0.1)',
              formInputTextColor: '#ffffff',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              packageEmployeeFormField: {
                labels: {
                  employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  any_employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                anyEmployeeVisible: true
              },
              packageLocationFormField: {
                labels: {
                  location: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              },
              packageRulesFormField: {
                labels: {
                  package_min_book: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  package_min_book_plural: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              },
              packageCalendarFormField: {
                labels: {
                  no_selected_slot_requirements: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                endDateVisibility: true,
                timeZoneVisibility: true
              }
            }
          },
          packageListForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052'
            },
            itemsStatic: {
              packageListFormField: {
                labels: {
                  package_list_overview: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  appointments: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  appointment: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  date: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  time: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  location: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          confirmBookingForm: {
            appointment: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052'
              },
              itemsStatic: {
                confirmServiceHeadingFormField: {
                  visibility: true
                },
                confirmHeadingDataFormField: {
                  labels: {
                    employee: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    date_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    time_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    location_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                recurringStringFormField: {
                  labels: {
                    recurring_active: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                paymentMethodFormField: {
                  labels: {
                    payment_method_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                stripeCardFormField: {
                  labels: {
                    credit_or_debit_card_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                }
              },
              itemsDraggable: {
                firstNameFormField: {
                  labels: {
                    first_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                lastNameFormField: {
                  labels: {
                    last_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: true
                },
                emailFormField: {
                  labels: {
                    email_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredEmailField
                },
                phoneFormField: {
                  labels: {
                    phone_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredPhoneNumberField
                }
              }
            },
            package: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052'
              },
              itemsStatic: {
                paymentMethodFormField: {
                  labels: {
                    payment_method_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                stripeCardFormField: {
                  labels: {
                    credit_or_debit_card_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                }
              },
              itemsDraggable: {
                firstNameFormField: {
                  labels: {
                    first_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                lastNameFormField: {
                  labels: {
                    last_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: true
                },
                emailFormField: {
                  labels: {
                    email_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredEmailField
                },
                phoneFormField: {
                  labels: {
                    phone_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredPhoneNumberField
                }
              }
            }
          },
          congratulationsForm: {
            appointment: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052',
                formImageColor: '#1A84EE'
              },
              itemsStatic: {
                congratulationsHeadingFormField: {
                  labels: {
                    congratulations: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                congratulationsImageFormField: {
                  visibility: true
                },
                congratulationsMessagesFormField: {
                  labels: {
                    booking_completed_approved: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    booking_completed_pending: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                addToCalendarFormField: {
                  addToCalendarVisibility: true
                }
              }
            },
            package: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052',
                formImageColor: '#1A84EE'
              },
              itemsStatic: {
                congratulationsHeadingFormField: {
                  labels: {
                    congratulations: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                congratulationsImageFormField: {
                  visibility: true
                },
                congratulationsMessagesFormField: {
                  labels: {
                    booking_completed_approved: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    booking_completed_pending: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                addToCalendarFormField: {
                  addToCalendarVisibility: true
                }
              }
            }
          }
        },
        eventListForm: {
          globalSettings: {
            formBackgroundColor: '#ffffff',
            formTextColor: '#354052',
            formInputColor: '#ffffff',
            formInputTextColor: '#354052',
            formDropdownColor: '#ffffff',
            formDropdownTextColor: '#354052'
          },
          eventFilterForm: {
            itemsStatic: {
              eventFilterFormField: {
                labels: {
                  event_type: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  event_location: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          eventDetailsForm: {
            itemsStatic: {
              eventDetailsFormField: {
                labels: {
                  open: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  closed: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  canceled: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  full: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  upcoming: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  event_capacity: {
                    value: '',
                    translations: {
                      x: ''
                    },
                    visibility: true
                  },
                  location: {
                    visibility: true
                  },
                  event_date: {
                    visibility: true
                  },
                  time_zone: {
                    visibility: false
                  },
                  event_free: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  event_price: {
                    visibility: true
                  },
                  event_about: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  event_book: {
                    value: '',
                    translations: {
                      x: ''
                    },
                    visibility: true
                  },
                  event_book_persons: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                showSingleEvent: true
              }
            }
          },
          confirmBookingForm: {
            event: {
              itemsStatic: {
                paymentMethodFormField: {
                  labels: {
                    payment_method_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                stripeCardFormField: {
                  labels: {
                    credit_or_debit_card_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                }
              },
              itemsDraggable: {
                firstNameFormField: {
                  labels: {
                    first_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                lastNameFormField: {
                  labels: {
                    last_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: true
                },
                emailFormField: {
                  labels: {
                    email_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredEmailField
                },
                phoneFormField: {
                  labels: {
                    phone_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredPhoneNumberField
                }
              }
            }
          },
          congratulationsForm: {
            event: {
              itemsStatic: {
                congratulationsHeadingFormField: {
                  labels: {
                    congratulations: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                congratulationsImageFormField: {
                  visibility: true
                },
                congratulationsMessagesFormField: {
                  labels: {
                    booking_completed_approved: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    booking_completed_pending: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                addToCalendarFormField: {
                  addToCalendarVisibility: true
                }
              }
            }
          }
        },
        catalogForm: {
          catalogListForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052'
            },
            labels: {
              categories: {
                value: '',
                translations: {
                  x: ''
                },
                visibility: true
              },
              services_lower: {
                value: '',
                translations: {
                  x: ''
                },
                visibility: true
              }
            },
            parts: {
              service_images_thumbs: {
                visibility: true
              }
            }
          },
          categoryListForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052'
            },
            labels: {
              back: {
                value: '',
                translations: {
                  x: ''
                }
              },
              view_more: {
                value: '',
                translations: {
                  x: ''
                }
              },
              price_colon: {
                value: '',
                translations: {
                  x: ''
                }
              },
              services: {
                value: '',
                translations: {
                  x: ''
                }
              },
              package: {
                value: '',
                translations: {
                  x: ''
                }
              },
              package_discount_text: {
                value: '',
                translations: {
                  x: ''
                }
              }
            },
            parts: {
              service_badge: {
                visibility: true
              },
              service_price: {
                visibility: true
              },
              service_employees_list: {
                visibility: true
              },
              package_badge: {
                visibility: true
              },
              package_price: {
                visibility: true
              },
              package_services_list: {
                visibility: true
              }
            }
          },
          categoryServiceForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052'
            },
            labels: {
              capacity_colon: {
                value: '',
                translations: {
                  x: ''
                }
              },
              duration_colon: {
                value: '',
                translations: {
                  x: ''
                }
              },
              description: {
                value: '',
                translations: {
                  x: ''
                }
              },
              service_info: {
                value: '',
                translations: {
                  x: ''
                }
              },
              category_colon: {
                value: '',
                translations: {
                  x: ''
                }
              },
              extras: {
                value: '',
                translations: {
                  x: ''
                }
              },
              price_colon: {
                value: '',
                translations: {
                  x: ''
                }
              },
              maximum_quantity_colon: {
                value: '',
                translations: {
                  x: ''
                }
              },
              description_colon: {
                value: '',
                translations: {
                  x: ''
                }
              },
              employees: {
                value: '',
                translations: {
                  x: ''
                }
              }
            },
            parts: {
              capacity_colon: {
                visibility: true
              },
              duration_colon: {
                visibility: true
              },
              description: {
                visibility: true
              },
              service_info: {
                visibility: true
              },
              extras: {
                visibility: true
              },
              employees: {
                visibility: true
              }
            }
          },
          categoryPackageForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052'
            },
            parts: {
              package_rules_description: {
                visibility: true
              },
              selected_services: {
                visibility: true
              }
            }
          },
          selectServiceForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052',
              formInputColor: '#ffffff',
              formInputTextColor: '#354052',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              serviceHeadingFormField: {
                labels: {
                  book_appointment: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              }
            },
            itemsDraggable: {
              locationFormField: {
                labels: {
                  locations: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true,
                required: false
              },
              employeeFormField: {
                labels: {
                  employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  any_employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true,
                required: false,
                anyEmployeeVisible: true
              },
              bringingFormField: {
                labels: {
                  bringing_anyone_with_you: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  number_of_additional_persons: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              },
              addExtraFormField: {
                labels: {
                  add_extra: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  extra_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  qty_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  duration_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  price_colon: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              }
            }
          },
          calendarDateTimeForm: {
            globalSettings: {
              formTextColor: '#ffffff',
              formGradientColor1: '#1A84EE',
              formGradientColor2: '#0454A2',
              formGradientAngle: 135
            },
            itemsStatic: {
              timeZoneFormField: {
                visibility: false
              },
              calendarHeadingFormField: {
                labels: {
                  pick_date_and_time: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              calendarAppointmentFormField: {
                endDateVisibility: true
              },
              recurringSwitchFormField: {
                labels: {
                  recurring_active: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              }
            }
          },
          recurringSetupForm: {
            globalSettings: {
              formTextColor: '#ffffff',
              formGradientColor1: '#1A84EE',
              formGradientColor2: '#0454A2',
              formGradientAngle: 135,
              formInputColor: 'rgba(0, 0, 0, 0)',
              formInputTextColor: '#ffffff',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              recurringSetupHeadingFormField: {
                labels: {
                  recurring_active: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              recurringSettingsFormField: {
                labels: {
                  recurring_repeat: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_every: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_on: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_until: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_times: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          recurringDatesForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052',
              formInputColor: '#ffffff',
              formInputTextColor: '#354052',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              recurringDatesHeadingFormField: {
                labels: {
                  recurring_appointments: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  recurring_edit: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                visibility: true
              },
              recurringInfoFormField: {
                labels: {
                  date: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  time: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          packageSetupForm: {
            globalSettings: {
              formTextColor: '#ffffff',
              formGradientColor1: '#1A84EE',
              formGradientColor2: '#0454A2',
              formGradientAngle: 135,
              formInputColor: 'rgba(0, 0, 0, 0.1)',
              formInputTextColor: '#ffffff',
              formDropdownColor: '#ffffff',
              formDropdownTextColor: '#354052'
            },
            itemsStatic: {
              packageEmployeeFormField: {
                labels: {
                  employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  any_employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                anyEmployeeVisible: true
              },
              packageLocationFormField: {
                labels: {
                  location: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              },
              packageRulesFormField: {
                labels: {
                  package_min_book: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  package_min_book_plural: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              },
              packageCalendarFormField: {
                labels: {
                  no_selected_slot_requirements: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                },
                endDateVisibility: true,
                timeZoneVisibility: true
              }
            }
          },
          packageListForm: {
            globalSettings: {
              formBackgroundColor: '#ffffff',
              formTextColor: '#354052'
            },
            itemsStatic: {
              packageListFormField: {
                labels: {
                  appointments: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  appointment: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  date: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  time: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  employee: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  },
                  location: {
                    value: '',
                    translations: {
                      x: ''
                    }
                  }
                }
              }
            }
          },
          confirmBookingForm: {
            appointment: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052'
              },
              itemsStatic: {
                confirmServiceHeadingFormField: {
                  visibility: true
                },
                confirmHeadingDataFormField: {
                  labels: {
                    employee: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    date_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    time_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    location_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                recurringStringFormField: {
                  labels: {
                    recurring_active: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                paymentMethodFormField: {
                  labels: {
                    payment_method_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                stripeCardFormField: {
                  labels: {
                    credit_or_debit_card_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                }
              },
              itemsDraggable: {
                firstNameFormField: {
                  labels: {
                    first_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                lastNameFormField: {
                  labels: {
                    last_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: true
                },
                emailFormField: {
                  labels: {
                    email_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredEmailField
                },
                phoneFormField: {
                  labels: {
                    phone_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredPhoneNumberField
                }
              }
            },
            package: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052'
              },
              itemsStatic: {
                paymentMethodFormField: {
                  labels: {
                    payment_method_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                stripeCardFormField: {
                  labels: {
                    credit_or_debit_card_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                }
              },
              itemsDraggable: {
                firstNameFormField: {
                  labels: {
                    first_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  }
                },
                lastNameFormField: {
                  labels: {
                    last_name_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: true
                },
                emailFormField: {
                  labels: {
                    email_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredEmailField
                },
                phoneFormField: {
                  labels: {
                    phone_colon: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true,
                  required: this.$root.settings.general.requiredPhoneNumberField
                }
              }
            }
          },
          congratulationsForm: {
            appointment: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052',
                formImageColor: '#1A84EE'
              },
              itemsStatic: {
                congratulationsHeadingFormField: {
                  labels: {
                    congratulations: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                congratulationsImageFormField: {
                  visibility: true
                },
                congratulationsMessagesFormField: {
                  labels: {
                    booking_completed_approved: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    booking_completed_pending: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                addToCalendarFormField: {
                  addToCalendarVisibility: true
                }
              }
            },
            package: {
              globalSettings: {
                formBackgroundColor: '#ffffff',
                formTextColor: '#354052',
                formInputColor: '#ffffff',
                formInputTextColor: '#354052',
                formDropdownColor: '#ffffff',
                formDropdownTextColor: '#354052',
                formImageColor: '#1A84EE'
              },
              itemsStatic: {
                congratulationsHeadingFormField: {
                  labels: {
                    congratulations: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                congratulationsImageFormField: {
                  visibility: true
                },
                congratulationsMessagesFormField: {
                  labels: {
                    booking_completed_approved: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    },
                    booking_completed_pending: {
                      value: '',
                      translations: {
                        x: ''
                      }
                    }
                  },
                  visibility: true
                },
                addToCalendarFormField: {
                  addToCalendarVisibility: true
                }
              }
            }
          }
        }
      }
    }
  },

  methods: {
    getTranslatedForms (form) {
      let forms = this.$root.settings.customization.forms ? this.$root.settings.customization.forms : this.defaultFormsData

      let locale = window.localeLanguage[0]

      Object.keys(forms[form]).forEach(
        (screen) => {
          if ('labels' in forms[form][screen]) {
            this.getTranslatedLabels(forms[form][screen], locale)
          } else if (screen !== 'confirmBookingForm' && screen !== 'globalSettings' && screen !== 'congratulationsForm') {
            forms[form][screen] = this.getTranslatedFormScreen(forms[form][screen], form, screen, locale)
          } else if (screen === 'confirmBookingForm' || screen === 'congratulationsForm') {
            Object.keys(forms[form][screen]).forEach(
              (entity) => {
                forms[form][screen][entity] = this.getTranslatedFormScreen(forms[form][screen][entity], form, screen, locale)
              }
            )
          }
        }
      )

      return forms
    },

    getTranslatedFormScreen (forms, form, screen, locale) {
      let itemNames = ['itemsDraggable', 'itemsStatic']

      itemNames.forEach(
        (item) => {
          if (item in forms) {
            Object.keys(forms[item]).forEach(
              (block) => {
                this.getTranslatedLabels(forms[item][block], locale)
              }
            )
          }
        }
      )

      return forms
    },

    getTranslatedLabels (element, locale) {
      if ('labels' in element) {
        Object.keys(element.labels).forEach(
          (name) => {
            if ('translations' in element.labels[name] &&
              locale in element.labels[name].translations
            ) {
              element.labels[name].value = element.labels[name].translations[locale]
            }
          }
        )
      }
    },

    rgbaToHex (rgba) {
      if (rgba.indexOf('#') < 0) {
        let sep = rgba.indexOf(',') > -1 ? ',' : ' '
        rgba = rgba.substr(5).split(')')[0].split(sep)

        if (rgba.indexOf('/') > -1) {
          rgba.splice(3, 1)
        }

        for (let R in rgba) {
          let r = rgba[R]
          if (r.indexOf('%') > -1) {
            let p = r.substr(0, r.length - 1) / 100

            if (R < 3) {
              rgba[R] = Math.round(p * 255)
            } else {
              rgba[R] = p
            }
          }
        }

        let r = (+rgba[0]).toString(16)
        let g = (+rgba[1]).toString(16)
        let b = (+rgba[2]).toString(16)
        let a = Math.round(+rgba[3] * 255).toString(16)

        if (r.length === 1) {
          r = '0' + r
        }
        if (g.length === 1) {
          g = '0' + g
        }
        if (b.length === 1) {
          b = '0' + b
        }
        if (a.length === 1) {
          a = '0' + a
        }

        return '#' + r + g + b + a
      }

      return rgba
    },

    oppositeColor (bgrColor) {
      let color = this.rgbaToHex(bgrColor)
      color = color.substring(1).slice(0, 6)
      color = parseInt(color, 16)
      color = 0xFFFFFF ^ color
      color = color.toString(16)
      color = ('000000' + color).slice(-6)
      color = '#' + color
      return color
    }
  }
}
