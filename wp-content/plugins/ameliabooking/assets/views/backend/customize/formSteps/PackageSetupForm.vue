<template>
  <div
    class="am-package-setup"
    :class="{'editable': editable}"
    :style="{'background': `linear-gradient(${customizationForm.formGradientAngle}deg, ${customizationForm.formGradientColor1} 0%, ${customizationForm.formGradientColor2} 100%)`}"
  >
    <customization-form-header
      :editable="editable"
      :customization-form="customizationForm"
      @resetForm="resetForm"
      @saveFormEdit="saveFormEdit"
    ></customization-form-header>

    <el-form label-position="top">
      <p class="am-package-service-name" :style="{color: customizationForm.formTextColor}">Service Name</p>

      <el-row :gutter="editable ? 48 : 22" type="flex" class="am-package-employee-location">
        <el-col :sm="24">
          <package-employee-form-field
            :language-short-code="languageShortCode"
            :customization="customization"
            :customization-edit="customizationEditDisplay"
            :customization-form="customizationForm"
            :form-field="formStepData.itemsStatic.packageEmployeeFormField"
            @saveEdit="saveFormEdit"
          ></package-employee-form-field>
        </el-col>

        <el-col :sm="24">
          <package-location-form-field
            :language-short-code="languageShortCode"
            :customization="customization"
            :customization-edit="customizationEditDisplay"
            :customization-form="customizationForm"
            :form-field="formStepData.itemsStatic.packageLocationFormField"
            @saveEdit="saveFormEdit"
          ></package-location-form-field>
        </el-col>
      </el-row>

      <package-rules-form-field
        :language-short-code="languageShortCode"
        :customization="customization"
        :customization-edit="customizationEditDisplay"
        :customization-form="customizationForm"
        :form-field="formStepData.itemsStatic.packageRulesFormField"
        @saveEdit="saveFormEdit"
      ></package-rules-form-field>

      <package-calendar-form-field
        :language-short-code="languageShortCode"
        :customization="customization"
        :customization-edit="customizationEditDisplay"
        :customization-form="customizationForm"
        :form-field="formStepData.itemsStatic.packageCalendarFormField"
        @saveEdit="saveFormEdit"
      ></package-calendar-form-field>

      <div
        class="el-button el-button--default"
        :style="{
          color: customization.textColorOnBackground,
          backgroundColor: `${customization.textColorOnBackground}1a`,
          borderColor: `${customization.textColorOnBackground}33`,
          marginTop: '10px',
          width: '100%'
        }"
        @mouseenter="mouseEnterDefault"
        @mouseleave="mouseLeaveDefault"
      >
        {{ $root.labels.package_next_appointment }}
      </div>

      <div class="am-button-wrapper">
        <div
          class="el-button el-button--default"
          :style="{color: customization.primaryColor}"
          @mouseenter="mouseEnterPrimary"
          @mouseleave="mouseLeavePrimary"
        >
          {{ $root.labels.continue }}
        </div>
      </div>
    </el-form>
  </div>
</template>

<script>
import formsCustomizationMixin from '../../../../js/common/mixins/formsCustomizationMixin'
import packageEmployeeFormField from '../formFields/PackageEmployeeFormField'
import packageLocationFormField from '../formFields/PackageLocationFormField'
import packageRulesFormField from '../formFields/PackageRulesFormField'
import packageCalendarFormField from '../formFields/PackageCalendarFormField'
import customizationFormHeader from '../parts/CustomizationFormHeader'

export default {
  name: 'packageSetupForm',

  components: {
    packageEmployeeFormField,
    packageLocationFormField,
    packageRulesFormField,
    packageCalendarFormField,
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
        editable: this.editable
      },
      draggableFormParts: []
    }
  },

  created () {
    this.customizationEdit.reverseBackgroundColorForm = this.oppositeColor(this.formStepData.globalSettings.formGradientColor1)
  },

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

    mouseEnterDefault (a) {
      let style = {
        color: this.customization.primaryColor,
        backgroundColor: this.customization.textColorOnBackground,
        borderColor: this.customization.textColorOnBackground
      }

      Object.assign(a.target.style, style)
    },

    mouseLeaveDefault (a) {
      let style = {
        color: this.customization.textColorOnBackground,
        backgroundColor: `${this.customization.textColorOnBackground}1a`,
        borderColor: `${this.customization.textColorOnBackground}33`
      }

      Object.assign(a.target.style, style)
    },

    mouseEnterPrimary (a) {
      let style = {
        backgroundColor: 'rgba(255, 255, 255, 0.85)'
      }

      Object.assign(a.target.style, style)
    },

    mouseLeavePrimary (a) {
      let style = {
        backgroundColor: 'rgba(255, 255, 255, 1)'
      }

      Object.assign(a.target.style, style)
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
