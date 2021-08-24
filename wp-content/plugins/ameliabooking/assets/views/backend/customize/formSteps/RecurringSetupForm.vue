<template>
  <div
    class="am-recurring am-recurring-setup"
    :class="{'editable': editable}"
    :style="{'background': `linear-gradient(${customizationForm.formGradientAngle}deg, ${customizationForm.formGradientColor1} 0%, ${customizationForm.formGradientColor2} 100%)`}"
  >
    <customization-form-header
      :editable="editable"
      :customization-form="customizationForm"
      @resetForm="resetForm"
      @saveFormEdit="saveFormEdit"
    ></customization-form-header>

    <recurring-setup-heading-form-field
      :language-short-code="languageShortCode"
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.recurringSetupHeadingFormField"
      @saveEdit="saveFormEdit"
    ></recurring-setup-heading-form-field>

    <recurring-settings-form-field
      :language-short-code="languageShortCode"
      :customization="customization"
      :customization-edit="customizationEditDisplay"
      :customization-form="customizationForm"
      :form-field="formStepData.itemsStatic.recurringSettingsFormField"
      @saveEdit="saveFormEdit"
    ></recurring-settings-form-field>
  </div>
</template>

<script>
import formsCustomizationMixin from '../../../../js/common/mixins/formsCustomizationMixin'
import recurringSetupHeadingFormField from '../formFields/RecurringSetupHeadingFormField'
import recurringSettingsFormField from '../formFields/RecurringSettingsFormField'
import customizationFormHeader from '../parts/CustomizationFormHeader'

export default {
  name: 'recurringSetupForm',

  components: {
    recurringSetupHeadingFormField,
    recurringSettingsFormField,
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

  mixins: [formsCustomizationMixin],

  data () {
    return {
      resetFormData: this.resetData ? this.resetData[this.$options.name] : {},
      customizationEdit: {
        editable: this.editable,
        reverseBackgroundColorForm: '#ffffff'
      }
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
