<template>
  <div
    class="am-congratulations"
    :class="{'editable': editable}"
    :style="{backgroundColor: formStepData.hasOwnProperty('globalSettings') ? customizationForm.formBackgroundColor : ''}"
  >
    <customization-form-header
      v-if="formStepData.hasOwnProperty('globalSettings') && Object.keys(this.resetData).length"
      :editable="editable"
      :customization-form="customizationForm"
      @resetForm="resetForm"
      @saveFormEdit="saveFormEdit"
    ></customization-form-header>

    <congratulations-heading-form-field
      :language-short-code="languageShortCode"
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.congratulationsHeadingFormField"
      @saveEdit="saveFormEdit"
    ></congratulations-heading-form-field>

    <congratulations-image-form-field
      :language-short-code="languageShortCode"
      :event-color="eventColor"
      :customize-display="customizeDisplay"
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.congratulationsImageFormField"
      @saveEdit="saveFormEdit"
    ></congratulations-image-form-field>

    <congratulations-messages-form-field
      :language-short-code="languageShortCode"
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.congratulationsMessagesFormField"
      @saveEdit="saveFormEdit"
    ></congratulations-messages-form-field>

    <br>

    <add-to-calendar-form-field
      :language-short-code="languageShortCode"
      :event-color="eventColor"
      :customization="customization"
      :customize-display="customizeDisplay"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.addToCalendarFormField"
      @saveEdit="saveFormEdit"
    ></add-to-calendar-form-field>

  </div>
</template>

<script>
import formsCustomizationMixin from '../../../../js/common/mixins/formsCustomizationMixin'
import customizationFormHeader from '../parts/CustomizationFormHeader'
import congratulationsHeadingFormField from '../formFields/CongratulationsHeadingFormField'
import congratulationsImageFormField from '../formFields/CongratulationsImageFormField'
import congratulationsMessagesFormField from '../formFields/CongratulationsMessagesFormField'
import addToCalendarFormField from '../formFields/AddToCalendarFormField'

export default {
  name: 'congratulationsForm',

  components: {
    customizationFormHeader,
    congratulationsHeadingFormField,
    congratulationsImageFormField,
    congratulationsMessagesFormField,
    addToCalendarFormField
  },

  props: {
    languageShortCode: {
      type: String,
      default: ''
    },
    editable: {
      type: Boolean,
      default: true
    },
    eventColor: {
      type: String,
      default: '#1A84EE'
    },
    customization: {
      type: Object,
      default: () => {
        return {}
      }
    },
    customizeDisplay: {
      type: String,
      default: ''
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
    },
    resetData: {
      type: Object,
      default: () => {
        return {}
      }
    }
  },

  mixins: [formsCustomizationMixin],

  data () {
    return {
      calendarIndex: '',
      calendars: [
        {
          type: 'google',
          label: 'Google Calendar'
        },
        {
          type: 'yahoo',
          label: 'Yahoo! Calendar'
        },
        {
          type: 'ios',
          label: 'iCal Calendar'
        },
        {
          'type': 'outlook',
          'label': 'Outlook Calendar'
        }
      ],
      resetFormData: Object.keys(this.resetData).length ? this.resetData[this.$options.name][this.customizeDisplay] : {},
      customizationEdit: {
        editable: this.editable,
        reverseBackgroundColorForm: '#ffffff'
      }
    }
  },

  created () {
    this.customizationEdit.reverseBackgroundColorForm = this.oppositeColor(this.customizationForm.formBackgroundColor)
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
      resetObj.formPart = this.customizeDisplay
      this.$emit('resetForm', resetObj)
    },

    saveFormEdit (dataObj) {
      let formObj = {}
      formObj[this.$options.name] = {}
      formObj[this.$options.name][this.customizeDisplay] = JSON.parse(JSON.stringify(dataObj))

      this.$emit('saveEdit', formObj)
    }
  },

  watch: {
    'formStepData' () {
      this.customizationEdit.reverseBackgroundColorForm = this.oppositeColor(this.customizationForm.formBackgroundColor)
    }
  }
}
</script>
