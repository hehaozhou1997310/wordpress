<template>
  <div
    class="am-select-date"
    :class="{'editable': editable}"
    :style="{'background': `linear-gradient(${customizationForm.formGradientAngle}deg, ${customizationForm.formGradientColor1} 0%, ${customizationForm.formGradientColor2} 100%)`}"
  >
    <customization-form-header
      :editable="editable"
      :customization-form="customizationForm"
      @resetForm="resetForm"
      @saveFormEdit="saveFormEdit"
    ></customization-form-header>

    <calendar-heading-form-field
      :language-short-code="languageShortCode"
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.calendarHeadingFormField"
      @saveEdit="saveFormEdit"
    ></calendar-heading-form-field>

    <time-zone-form-field
      :language-short-code="languageShortCode"
      :customization-edit="customizationEdit"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.timeZoneFormField"
      @saveEdit="saveFormEdit"
    ></time-zone-form-field>

    <!-- Datepicker -->
    <calendar-appointment-form-field
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.calendarAppointmentFormField"
      @saveEdit="saveFormEdit"
    ></calendar-appointment-form-field>

    <recurring-switch-form-field
      :language-short-code="languageShortCode"
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.recurringSwitchFormField"
      @saveEdit="saveFormEdit"
    ></recurring-switch-form-field>

    <!-- Continue -->
    <div class="am-button-wrapper">
      <button
        type="button"
        class="el-button el-button--default"
        :style="{ 'background-color': '#FFFFFF' }"
      >
        <span :style="{ 'color': customization.primaryColor}">{{ $root.labels.continue }}</span>
      </button>
    </div>
  </div>
</template>

<script>
import dateMixin from '../../../../js/common/mixins/dateMixin'
import formsCustomizationMixin from '../../../../js/common/mixins/formsCustomizationMixin'
import calendarHeadingFormField from '../formFields/CalendarHeadingFormField'
import timeZoneFormField from '../formFields/TimeZoneFormField'
import calendarAppointmentFormField from '../formFields/CalendarAppointmentFormField'
import recurringSwitchFormField from '../formFields/RecurringSwitchFormField'
import customizationFormHeader from '../parts/CustomizationFormHeader'

export default {
  name: 'calendarDateTimeForm',

  components: {
    calendarHeadingFormField,
    timeZoneFormField,
    calendarAppointmentFormField,
    recurringSwitchFormField,
    customizationFormHeader
  },

  props: {
    languageShortCode: {
      type: String,
      default: ''
    },
    customization: {
      type: Object,
      default: () => {
        return {}
      }
    },
    editable: {
      type: Boolean,
      default: true
    },
    resetData: {
      type: Object,
      default: () => {
        return {}
      }
    },
    customizationForm: {
      type: Object,
      default: () => {
        return {}
      }
    },
    formStepData: {
      type: Object,
      default: () => {
        return {}
      }
    }
  },

  mixins: [dateMixin, formsCustomizationMixin],

  data () {
    return {
      resetFormData: this.resetData ? this.resetData[this.$options.name] : {},
      selectedDate: this.$moment().toDate(),
      customizationEdit: {
        editable: this.editable
      },
      draggableFormParts: []
    }
  },

  created () {
    this.customizationEdit.reverseBackgroundColorForm = this.oppositeColor(this.formStepData.globalSettings.formGradientColor1)
  },

  mounted () {},

  computed: {
    customizationEditDisplay () {
      this.customizationEdit.editable = this.editable
      return this.customizationEdit
    }
  },

  methods: {
    resetForm () {
      let resetObj = {}
      resetObj.data = this.resetFormData
      resetObj.formStep = this.$options.name
      this.$emit('resetForm', resetObj)
    },
    saveFormEdit (dataObj) {
      let formObj = {}
      formObj[this.$options.name] = JSON.parse(JSON.stringify(dataObj))
      this.$emit('saveEdit', formObj)
    }
  },

  watch: {
    'formStepData' () {
      this.customizationEdit.reverseBackgroundColorForm = this.oppositeColor(this.formStepData.globalSettings.formGradientColor1)
    }
  }
}
</script>
