<template>
  <div
    class="am-select-package"
    :class="{'editable': editable}"
    :style="{backgroundColor: customizationForm.formBackgroundColor}"
  >
    <div class="am-select-package__inner">
      <customization-form-header
        :editable="editable"
        :customization-form="customizationForm"
        @resetForm="resetForm"
        @saveFormEdit="saveFormEdit"
      ></customization-form-header>

      <package-heading-form-field
        :language-short-code="languageShortCode"
        :customization="customization"
        :customization-edit="customizationEditDisplay"
        :customization-form="customizationForm"
        :form-field="formStepData.itemsStatic.packageHeadingFormField"
        @saveEdit="saveFormEdit"
      ></package-heading-form-field>

      <!-- Booking Form -->
      <el-form label-position="top">
        <package-form-field
          :language-short-code="languageShortCode"
          :customization="customization"
          :customization-edit="customizationEdit"
          :customization-form="customizationForm"
          :form-field="formStepData.itemsStatic.packageFormField"
          @saveEdit="saveFormEdit"
        ></package-form-field>
      </el-form>

      <!-- Confirm Dialog Footer -->
      <div class="dialog-footer">
        <div
          class="el-button el-button--primary"
          :style="{backgroundColor: customization.primaryColor, borderColor: customization.primaryColor, color: customization.textColorOnBackground}"
          @mouseenter="mouseEnterPrimary"
          @mouseleave="mouseLeavePrimary"
        >
          <span>{{ $root.labels.confirm }}</span>
        </div>
      </div>
      <!-- /Confirm Dialog Footer -->
    </div>
  </div>
</template>

<script>
import formsCustomizationMixin from '../../../../js/common/mixins/formsCustomizationMixin'
import packageFormField from '../formFields/PackageFormField'
import packageHeadingFormField from '../formFields/PackageHeadingFormField'
import formColorsEditDialog from '../dialogs/FormColorsEditDialog'
import customizationFormHeader from '../parts/CustomizationFormHeader'

export default {
  name: 'selectPackageForm',

  components: {
    packageFormField,
    packageHeadingFormField,
    formColorsEditDialog,
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
    this.customizationEdit.reverseBackgroundColorForm = this.oppositeColor(this.formStepData.globalSettings.formBackgroundColor)
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

    mouseEnterPrimary (a) {
      a.target.style.backgroundColor = `${this.customization.primaryColor}bf`
      a.target.style.borderColor = `${this.customization.primaryColor}bf`
    },

    mouseLeavePrimary (a) {
      a.target.style.backgroundColor = this.customization.primaryColor
      a.target.style.borderColor = this.customization.primaryColor
    },

    saveFormEdit (dataObj) {
      let formObj = {}
      formObj[this.$options.name] = JSON.parse(JSON.stringify(dataObj))

      this.$emit('saveEdit', formObj)
    }
  },

  watch: {
    'formStepData' () {
      this.customizationEdit.reverseBackgroundColorForm = this.oppositeColor(this.formStepData.globalSettings.formBackgroundColor)
    }
  }
}
</script>
