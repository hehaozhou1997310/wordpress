<template>
  <div class="am-wrap">
    <!-- Preview Fonts Import -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- /Preview Fonts Import -->

    <div class="am-customize-page am-body">

      <!-- Page Header -->
      <page-header
        :addNewCustomFieldBtnDisplay="addNewCustomFieldBtnDisplay"
        @newCustomFieldBtnClicked="showDialogNewCustomFields()"
      >
      </page-header>

      <!-- Tabs -->
      <div class="am-customize am-section">
        <el-tabs v-model="activeTab">

          <!-- Customize - Colors, Fonts & Order -->
          <el-tab-pane :label="$root.labels.colors_and_fonts" name="customize">
            <BlockLite/>
            <!-- Customize Settings -->
            <div class="am-customize-settings-preview" :class="{'am-lite-container-disabled': $root.isLite}">
              <el-row class="am-flexed">
                <!-- Customize Settings Inputs -->
                <el-col :lg="6" class="">
                  <div class="am-customize-settings">
                    <!-- Global Customize options notice -->
                    <div class="am-setting">
                      <el-alert
                          type="warning"
                          show-icon
                          title=""
                          :description="$root.labels.global_customize_settings_notice"
                          :closable="false"
                      />
                    </div>
                    <!-- /Global Customize options notice -->
                    <!-- Primary Color -->
                    <div class="am-setting">
                      <p>{{ $root.labels.primary_color }}</p>
                      <el-color-picker v-model="customization.primaryColor"></el-color-picker>
                    </div>
                    <!-- /Primary Color -->

                    <!-- Primary Gradient -->
                     <div class="am-setting">
                      <p>{{ $root.labels.primary_gradient }}</p>
                      <div class="am-gradient-picker">
                        <el-color-picker v-model="customization.primaryGradient1"></el-color-picker>
                        <el-color-picker v-model="customization.primaryGradient2"></el-color-picker>
                      </div>
                    </div>

                    <!-- Text Color -->
                    <div class="am-setting">
                      <p>{{ $root.labels.text_color }}</p>
                      <el-color-picker v-model="customization.textColor"></el-color-picker>
                    </div>
                    <!-- /Text Color -->

                    <!-- Text Color On Background -->
                    <div class="am-setting">
                      <p>{{ $root.labels.text_color_on_background }}</p>
                      <el-color-picker v-model="customization.textColorOnBackground"></el-color-picker>
                    </div>
                    <!-- /Text Color On Background -->

                    <!-- Font -->
                    <div class="am-setting">
                      <p>{{ $root.labels.font }}</p>
                      <el-select
                        v-model="customization.font"
                        value-key="customer.id"
                        placeholder=""
                        :disabled="$root.isLite"
                      >
                        <el-option
                          v-for="font in fonts"
                          :key="font.id"
                          :label="font.name"
                          :value="font.value"
                        >
                        </el-option>
                      </el-select>
                    </div>
                    <!-- /Font -->

                    <!-- Use Loaded Vue -->
                    <el-row class="am-setting">
                      <el-col :span="16">
                        <p style="display: inline-block">
                          {{ $root.labels.window_vue }}
                        </p>
                        <el-tooltip placement="top">
                          <div slot="content" v-html="$root.labels.window_vue_tooltip"></div>
                          <i class="el-icon-question am-tooltip-icon"></i>
                        </el-tooltip>
                      </el-col>
                      <el-col :span="8" class="align-right">
                        <el-switch
                          v-model="useWindowVueInAmelia"
                          active-text=""
                          inactive-text=""
                          active-color="#1A84EE"
                          @change="saveWindowVueSettings"
                        >
                        </el-switch>
                      </el-col>
                    </el-row>
                    <!-- /Use Loaded Vue -->

                    <!-- Reset & Save Buttons -->
                    <div class="am-actions">

                      <!-- Reset Button -->
                      <el-button @click="resetSettings()">
                        {{ $root.labels.reset }}
                      </el-button>

                      <!-- Save Button -->
                      <el-button
                        @click="saveSettings()"
                        :loading="loadingButton"
                        type="primary"
                      >
                        {{ $root.labels.save }}
                      </el-button>
                    </div>
                    <!-- /Reset & Save Buttons -->
                  </div>
                </el-col>
                <!-- /Customize Settings Inputs -->

                <!-- Customize Preview -->
                <el-col :lg="18" class="">
                  <div class="am-customize__header-wrapper">
                    <div class="am-customize__header">
                      <div class="am-customize__header-left-inner">
                        <span>{{ $root.labels.form }}</span>
                        <el-select
                          v-model="formType"
                          @change="changeFormType"
                          :disabled="$root.isLite"
                        >
                          <el-option
                            v-for="item in formTypeOptions"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value"
                          >
                          </el-option>
                        </el-select>
                      </div>
                      <div v-if="customizeDisplayOptions.length" class="am-customize__header-left-inner">
                        <span>{{ $root.labels.form_flow }}</span>
                        <el-select v-model="customizeDisplay" :disabled="$root.isLite">
                          <el-option
                            v-for="item in customizeDisplayOptions"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value"
                          >
                          </el-option>
                        </el-select>
                      </div>
                    </div>
                    <div class="am-customize__header">
                      <div class="am-customize__header-right-inner">
                        <select-translate @languageChanged="languageChanged"></select-translate>
                      </div>
                      <div class="am-customize__header-right-inner">
                        <el-button
                          class="am-customize__preview"
                          :type="editable ? '' : 'primary'"
                          @click="editable = !editable"
                        >
                          {{ $root.labels.preview }}
                        </el-button>
                      </div>
                    </div>
                  </div>
                  <component
                    :is="formType"
                    :language-short-code="languageShortCode"
                    :customize-display="customizeDisplay"
                    :editable="editable"
                    :customization="customization"
                    :form-type-data="forms[formType]"
                    :reset-data="defaultFormsData[formType]"
                    @resetForm="resetForm"
                    @saveDraggableEdit="saveDraggableEdit"
                    @saveEdit="saveEdit"
                  ></component>
                </el-col>
                <!-- /Customize Preview -->

              </el-row>
            </div>
            <!-- /Customize Settings -->
          </el-tab-pane>
          <!-- /Customize - Colors, Fonts & Order -->

          <!-- Customize Custom Fields -->
          <el-tab-pane :label="$root.labels.custom_fields" name="customFields">
            <BlockLite/>

            <!-- Custom Fields -->
            <custom-fields
              :dialogCustomFields="dialogCustomFields"
              @closeDialogCustomFields="closeDialogCustomFields"
            >
            </custom-fields>

          </el-tab-pane>
          <!-- /Customize Custom Fields -->
        </el-tabs>
      </div>

      <DialogLite/>

      <!-- Help Button -->
      <el-col :md="6" class="">
        <a class="am-help-button" :href="needHelpPage" target="_blank">
          <i class="el-icon-question"></i> {{ $root.labels.need_help }}?
        </a>
      </el-col>

    </div>
  </div>
</template>

<script>
  import PageHeader from '../parts/PageHeader.vue'
  import formsCustomizationMixin from '../../../js/common/mixins/formsCustomizationMixin'
  import dateMixin from '../../../js/common/mixins/dateMixin'
  import notifyMixin from '../../../js/backend/mixins/notifyMixin'
  import imageMixin from '../../../js/common/mixins/imageMixin'
  import ElButton from '../../../../node_modules/element-ui/packages/button/src/button.vue'
  import CustomFields from './customfields/CustomFields.vue'
  import stepByStepForm from './formType/StepByStepForm'
  import eventListForm from './formType/EventListForm'
  import catalogForm from './formType/CatalogForm'
  import deepMerge from 'deepmerge'
  import SelectTranslate from '../parts/SelectTranslate'

  export default {
    components: {
      ElButton,
      PageHeader,
      CustomFields,
      stepByStepForm,
      eventListForm,
      catalogForm,
      SelectTranslate
    },

    mixins: [formsCustomizationMixin, dateMixin, notifyMixin, imageMixin],

    data () {
      return {
        formType: 'stepByStepForm',
        formTypeOptions: [
          {
            label: this.$root.labels.form_type_step_by_step,
            value: 'stepByStepForm'
          },
          {
            label: this.$root.labels.form_type_event_list,
            value: 'eventListForm'
          },
          {
            label: this.$root.labels.form_type_catalog,
            value: 'catalogForm'
          }
        ],
        customizeDisplay: 'appointment',
        customizeDisplayOptions: [
          {
            value: 'appointment',
            label: this.$root.labels.form_block_service
          },
          {
            value: 'package',
            label: this.$root.labels.form_block_package
          }
        ],
        editable: true,
        defaultCustomization: {
          primaryColor: '#1A84EE',
          primaryGradient1: '#1A84EE',
          primaryGradient2: '#0454A2',
          textColor: '#354052',
          textColorOnBackground: '#FCFDFF',
          font: 'Amelia Roboto, sans-serif'
        },
        useWindowVueInAmelia: true,
        activeTab: 'customize',
        activeFormType: '',
        customization: this.$root.settings.customization,
        dialogCustomFields: false,
        employee: this.$root.labels.any_employee,
        fonts: [
          {
            id: 1,
            name: 'Roboto',
            value: 'Amelia Roboto, sans-serif'
          },
          {
            id: 2,
            name: 'Lato',
            value: 'Amelia Lato'
          },
          {
            id: 3,
            name: 'Merriweather',
            value: 'Amelia Merriweather, serif'
          },
          {
            id: 4,
            name: 'Montserrat',
            value: 'Amelia Montserrat, sans-serif'
          },
          {
            id: 5,
            name: 'Mulish',
            value: 'Amelia Mulish, sans-serif'
          },
          {
            id: 6,
            name: 'Nunito',
            value: 'Amelia Nunito, sans-serif'
          },
          {
            id: 7,
            name: 'Asap Condensed',
            value: 'Amelia Asap Condensed, sans-serif'
          },
          {
            id: 8,
            name: 'Open Sans',
            value: 'Amelia Open Sans, sans-serif'
          },
          {
            id: 9,
            name: 'Barlow',
            value: 'Amelia Barlow, sans-serif'
          },
          {
            id: 10,
            name: 'Oswald',
            value: 'Amelia Oswald, sans-serif'
          },
          {
            id: 11,
            name: 'Bitter',
            value: 'Amelia Bitter, serif'
          },
          {
            id: 12,
            name: 'Poppins',
            value: 'Amelia Poppins, sans-serif'
          },
          {
            id: 13,
            name: 'Carme',
            value: 'Amelia Carme, sans-serif'
          }
        ],
        loadingButton: false,
        switchValue: true,
        forms: {},
        languageShortCode: ''
      }
    },

    created () {
      this.fonts.forEach(item => {
        if (item.name === this.customization.font.split(',')[0]) {
          this.customization.font = item.value
        }
      })

      this.changeFormType('stepByStepForm')

      if (this.$root.settings.customization && this.$root.settings.customization.forms) {
        this.forms = deepMerge.all([this.$root.settings.customization.forms, this.defaultFormsData, this.$root.settings.customization.forms])
      } else {
        this.forms = this.getDefaultFormData()
      }
    },

    mounted () {
      if ('useGenerated' in this.customization) {
        delete this.customization.useGenerated
      }

      this.useWindowVueInAmelia = this.$root.settings.general.useWindowVueInAmelia
      this.inlineSVG()
    },

    methods: {
      languageChanged (selectedLanguage) {
      },

      changeFormType (type) {
      },

      getDefaultFormData () {
        let forms = JSON.parse(JSON.stringify({...this.defaultFormsData}))

        if (this.customization) {
          // STEP BY STEP - SELECT SERVICE FORM
          forms.stepByStepForm.selectServiceForm.globalSettings.formTextColor = this.customization.textColor
          forms.stepByStepForm.selectServiceForm.globalSettings.formInputTextColor = this.customization.textColor
          forms.stepByStepForm.selectServiceForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // STEP BY STEP - CALENDAR DATE TIME FORM
          forms.stepByStepForm.calendarDateTimeForm.globalSettings.formGradientColor1 = this.customization.primaryGradient1
          forms.stepByStepForm.calendarDateTimeForm.globalSettings.formGradientColor2 = this.customization.primaryGradient2
          forms.stepByStepForm.calendarDateTimeForm.globalSettings.formTextColor = this.customization.textColorOnBackground
          // STEP BY STEP - RECURRING SETUP FORM
          forms.stepByStepForm.recurringSetupForm.globalSettings.formTextColor = this.customization.textColorOnBackground
          forms.stepByStepForm.recurringSetupForm.globalSettings.formGradientColor1 = this.customization.primaryGradient1
          forms.stepByStepForm.recurringSetupForm.globalSettings.formGradientColor2 = this.customization.primaryGradient2
          forms.stepByStepForm.recurringSetupForm.globalSettings.formInputTextColor = this.customization.textColorOnBackground
          forms.stepByStepForm.recurringSetupForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // STEP BY STEP - RECURRING DATES FORM
          forms.stepByStepForm.recurringDatesForm.globalSettings.formTextColor = this.customization.textColor
          forms.stepByStepForm.recurringDatesForm.globalSettings.formInputColor = this.customization.textColorOnBackground
          forms.stepByStepForm.recurringDatesForm.globalSettings.formInputTextColor = this.customization.textColor
          forms.stepByStepForm.recurringDatesForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // STEP BY STEP - SELECT PACKAGE FORM
          forms.stepByStepForm.selectPackageForm.globalSettings.formTextColor = this.customization.textColor
          forms.stepByStepForm.selectPackageForm.globalSettings.formInputTextColor = this.customization.textColor
          forms.stepByStepForm.selectPackageForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // STEP BY STEP - PACKAGE INFO FORM
          forms.stepByStepForm.packageInfoForm.globalSettings.formTextColor = this.customization.textColor
          // STEP BY STEP - PACKAGE SETUP FORM
          forms.stepByStepForm.packageSetupForm.globalSettings.formTextColor = this.customization.textColorOnBackground
          forms.stepByStepForm.packageSetupForm.globalSettings.formGradientColor1 = this.customization.primaryGradient1
          forms.stepByStepForm.packageSetupForm.globalSettings.formGradientColor2 = this.customization.primaryGradient2
          forms.stepByStepForm.packageSetupForm.globalSettings.formInputTextColor = this.customization.textColorOnBackground
          forms.stepByStepForm.packageSetupForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // STEP BY STEP - PACKAGE LIST FORM
          forms.stepByStepForm.packageListForm.globalSettings.formTextColor = this.customization.textColor
          // STEP BY STEP - CONFIRM BOOKING FORM - APPOINTMENT
          forms.stepByStepForm.confirmBookingForm.appointment.globalSettings.formTextColor = this.customization.textColor
          forms.stepByStepForm.confirmBookingForm.appointment.globalSettings.formInputTextColor = this.customization.textColor
          forms.stepByStepForm.confirmBookingForm.appointment.globalSettings.formDropdownTextColor = this.customization.textColor
          // STEP BY STEP - CONFIRM BOOKING FORM - PACKAGE
          forms.stepByStepForm.confirmBookingForm.package.globalSettings.formTextColor = this.customization.textColor
          forms.stepByStepForm.confirmBookingForm.package.globalSettings.formInputTextColor = this.customization.textColor
          forms.stepByStepForm.confirmBookingForm.package.globalSettings.formDropdownTextColor = this.customization.textColor
          // STEP BY STEP - CONGRATULATIONS BOOKING FORM - APPOINTMENT
          forms.stepByStepForm.congratulationsForm.appointment.globalSettings.formTextColor = this.customization.textColor
          forms.stepByStepForm.congratulationsForm.appointment.globalSettings.formInputTextColor = this.customization.textColor
          forms.stepByStepForm.congratulationsForm.appointment.globalSettings.formDropdownTextColor = this.customization.textColor
          forms.stepByStepForm.congratulationsForm.appointment.globalSettings.formImageColor = this.customization.primaryColor
          // STEP BY STEP - CONGRATULATIONS BOOKING FORM - PACKAGE
          forms.stepByStepForm.congratulationsForm.package.globalSettings.formTextColor = this.customization.textColor
          forms.stepByStepForm.congratulationsForm.package.globalSettings.formInputTextColor = this.customization.textColor
          forms.stepByStepForm.congratulationsForm.package.globalSettings.formDropdownTextColor = this.customization.textColor
          forms.stepByStepForm.congratulationsForm.package.globalSettings.formImageColor = this.customization.primaryColor
          // EVENT LIST FORM
          forms.eventListForm.globalSettings.formTextColor = this.customization.textColor
          forms.eventListForm.globalSettings.formInputTextColor = this.customization.textColor
          forms.eventListForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // CATALOG FORM - SELECT SERVICE FORM
          forms.catalogForm.selectServiceForm.globalSettings.formTextColor = this.customization.textColor
          forms.catalogForm.selectServiceForm.globalSettings.formInputTextColor = this.customization.textColor
          forms.catalogForm.selectServiceForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // CATALOG FORM - CALENDAR DATE TIME FORM
          forms.catalogForm.calendarDateTimeForm.globalSettings.formGradientColor1 = this.customization.primaryGradient1
          forms.catalogForm.calendarDateTimeForm.globalSettings.formGradientColor2 = this.customization.primaryGradient2
          forms.catalogForm.calendarDateTimeForm.globalSettings.formTextColor = this.customization.textColorOnBackground
          // CATALOG FORM - RECURRING SETUP FORM
          forms.catalogForm.recurringSetupForm.globalSettings.formTextColor = this.customization.textColorOnBackground
          forms.catalogForm.recurringSetupForm.globalSettings.formGradientColor1 = this.customization.primaryGradient1
          forms.catalogForm.recurringSetupForm.globalSettings.formGradientColor2 = this.customization.primaryGradient2
          forms.catalogForm.recurringSetupForm.globalSettings.formInputTextColor = this.customization.textColorOnBackground
          forms.catalogForm.recurringSetupForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // CATALOG FORM - RECURRING DATES FORM
          forms.catalogForm.recurringDatesForm.globalSettings.formTextColor = this.customization.textColor
          forms.catalogForm.recurringDatesForm.globalSettings.formInputColor = this.customization.textColorOnBackground
          forms.catalogForm.recurringDatesForm.globalSettings.formInputTextColor = this.customization.textColor
          forms.catalogForm.recurringDatesForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // CATALOG FORM - PACKAGE SETUP FORM
          forms.catalogForm.packageSetupForm.globalSettings.formTextColor = this.customization.textColorOnBackground
          forms.catalogForm.packageSetupForm.globalSettings.formGradientColor1 = this.customization.primaryGradient1
          forms.catalogForm.packageSetupForm.globalSettings.formGradientColor2 = this.customization.primaryGradient2
          forms.catalogForm.packageSetupForm.globalSettings.formInputTextColor = this.customization.textColorOnBackground
          forms.catalogForm.packageSetupForm.globalSettings.formDropdownTextColor = this.customization.textColor
          // CATALOG FORM - PACKAGE LIST FORM
          forms.catalogForm.packageListForm.globalSettings.formTextColor = this.customization.textColor
          // CATALOG FORM - CONFIRM BOOKING FORM - APPOINTMENT
          forms.catalogForm.confirmBookingForm.appointment.globalSettings.formTextColor = this.customization.textColor
          forms.catalogForm.confirmBookingForm.appointment.globalSettings.formInputTextColor = this.customization.textColor
          forms.catalogForm.confirmBookingForm.appointment.globalSettings.formDropdownTextColor = this.customization.textColor
          // CATALOG FORM - CONFIRM BOOKING FORM - PACKAGE
          forms.catalogForm.confirmBookingForm.package.globalSettings.formTextColor = this.customization.textColor
          forms.catalogForm.confirmBookingForm.package.globalSettings.formInputTextColor = this.customization.textColor
          forms.catalogForm.confirmBookingForm.package.globalSettings.formDropdownTextColor = this.customization.textColor
          // CATALOG FORM - CONGRATULATIONS BOOKING FORM - APPOINTMENT
          forms.catalogForm.congratulationsForm.appointment.globalSettings.formTextColor = this.customization.textColor
          forms.catalogForm.congratulationsForm.appointment.globalSettings.formInputTextColor = this.customization.textColor
          forms.catalogForm.congratulationsForm.appointment.globalSettings.formDropdownTextColor = this.customization.textColor
          forms.catalogForm.congratulationsForm.appointment.globalSettings.formImageColor = this.customization.primaryColor
          // CATALOG FORM - CONGRATULATIONS BOOKING FORM - PACKAGE
          forms.catalogForm.congratulationsForm.package.globalSettings.formTextColor = this.customization.textColor
          forms.catalogForm.congratulationsForm.package.globalSettings.formInputTextColor = this.customization.textColor
          forms.catalogForm.congratulationsForm.package.globalSettings.formDropdownTextColor = this.customization.textColor
          forms.catalogForm.congratulationsForm.package.globalSettings.formImageColor = this.customization.primaryColor
        }

        return forms
      },

      resetForm (resetData) {
      },

      saveDraggableEdit (dataObj) {
      },

      saveEdit (dataObj) {
      },

      saveSettings () {},

      saveWindowVueSettings () {
        this.$http.post(`${this.$root.getAjaxUrl}/settings`, {useWindowVueInAmelia: this.useWindowVueInAmelia})
          .then(response => {
            this.notify(this.$root.labels.success, this.$root.labels.settings_saved, 'success')
          })
          .catch(e => {
            this.notify(this.$root.labels.error, e.message, 'error')
          })
      },

      resetSettings: function () {},

      showDialogNewCustomFields () {
        this.dialogCustomFields = true
      },

      closeDialogCustomFields () {
        this.dialogCustomFields = false
      }
    },

    computed: {
      addNewCustomFieldBtnDisplay () {
        return this.activeTab === 'customFields'
      },

      needHelpPage () {
        return this.activeTab === 'customize'
          ? 'https://wpamelia.com/customize-design/' : 'https://wpamelia.com/custom-fields/'
      }
    }
  }
</script>
