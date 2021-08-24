<template>
  <!-- Service -->
  <div
    class="am-customize-field"
    :class="{'editable': customizationEdit.editable}"
    :style="{borderColor: customizationEdit.reverseBackgroundColorForm}"
  >
    <el-row
      v-show="formField.addToCalendarVisibility"
      type="flex"
      justify="center"
    >
      <el-col :sm="12">
        <el-select
          v-model="calendarIndex"
          :popper-class="'am-dropdown'"
          :style="{ backgroundColor: customizationForm.formInputColor, color: customizationForm.formInputTextColor, borderColor: selectInputFocus ? customization.primaryColor : '#C0C4CC' }"
          :placeholder="$root.labels.select_calendar"
          @focus="inputFocus"
        >
          <el-option
            v-for="item in calendars"
            :key="item.name"
            :label="item.name"
            :value="item.name"
            :style="{
              backgroundColor: customizationForm.formDropdownColor,
              color: item.name === calendarIndex ? customization.primaryColor : customizationForm.formDropdownTextColor,
              fontFamily: customization.font
            }"
          >
          </el-option>
        </el-select>
      </el-col>
    </el-row>

    <br>

    <!-- Button -->
    <div
      v-show="formField.addToCalendarVisibility"
      class="el-button el-button--primary calendar-link"
      :class="{'is-disabled' : calendarIndex === null}"
      :style="{
        backgroundColor: customizeDisplay === 'event' ? eventColor : customization.primaryColor,
        borderColor: customizeDisplay === 'event' ? eventColor : customization.primaryColor
      }"
      @mouseenter="mouseEnter"
      @mouseleave="mouseLeave"
    >
      <span :style="{color: customization.textColorOnBackground}">
        {{ $root.labels.add_to_calendar }}
      </span>
    </div>

    <!-- Button Redirect URL After Appointment -->
    <div
      class="el-button el-button--primary redirect-link"
      :style="{
        backgroundColor: customizeDisplay === 'event' ? eventColor : customization.primaryColor,
        borderColor: customizeDisplay === 'event' ? eventColor : customization.primaryColor
      }"
      @mouseenter="mouseEnter"
      @mouseleave="mouseLeave"
    >
      <a :style="{color: customization.textColorOnBackground}">
        {{ $root.labels.finish_appointment }}
      </a>
    </div>

    <!-- Edit Dialog -->
    <customize-edit-dialog
      :form-field="formField"
      :language-short-code="languageShortCode"
      @saveEdit="saveFormFiledEdit"
    >
      <template v-slot:fieldEdit>
        <span v-show="customizationEdit.editable" class="am-customize-field__edit">
          <img :src="$root.getUrl + 'public/img/am-customize-icon-edit.svg'" />
        </span>
      </template>
    </customize-edit-dialog>
    <!-- /Edit Dialog -->
  </div>
  <!-- /Service -->
</template>

<script>
  import customizeEditDialog from '../dialogs/CustomizeEditDialog'

  export default {
    name: 'addToCalendarFormField',

    components: {
      customizeEditDialog
    },

    props: {
      languageShortCode: {
        type: String,
        default: ''
      },
      eventColor: {
        type: String,
        default: '#1A84EE'
      },
      customization: {
        type: Object
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
      customizationEdit: {
        type: Object,
        default: () => {
          return {}
        }
      },
      formField: {
        type: Object,
        default: () => {
          return {}
        }
      }
    },

    data () {
      return {
        calendarIndex: '',
        calendars: [
          {
            name: 'Google Calendar'
          },
          {
            name: 'Yahoo! Calendar'
          },
          {
            name: 'iCal Calendar'
          },
          {
            name: 'Outlook Calendar'
          }
        ],
        selectInputFocus: false
      }
    },

    mounted () {},

    methods: {
      mouseEnter (elem) {
        if (this.customizeDisplay === 'event') {
          let style = {
            borderColor: `${this.eventColor}99`,
            backgroundColor: `${this.eventColor}99`
          }

          Object.assign(elem.target.style, style)

          return false
        }

        let style = {
          borderColor: `${this.customization.primaryColor}99`,
          backgroundColor: `${this.customization.primaryColor}99`
        }

        Object.assign(elem.target.style, style)
      },

      mouseLeave (elem) {
        if (this.customizeDisplay === 'event') {
          let style = {
            borderColor: this.eventColor,
            backgroundColor: this.eventColor
          }

          Object.assign(elem.target.style, style)

          return false
        }

        let style = {
          borderColor: this.customization.primaryColor,
          backgroundColor: this.customization.primaryColor
        }

        Object.assign(elem.target.style, style)
      },

      inputFocus () {
        this.selectInputFocus = true
      },

      componentDisplay () {
        if (this.formField.hasOwnProperty('visibility')) {
          return this.formField.visibility
        }

        return true
      },

      saveFormFiledEdit (objData) {
        let fieldData = {}
        fieldData['itemsStatic'] = {}
        fieldData['itemsStatic'][this.$options.name] = JSON.parse(JSON.stringify(objData))
        this.$emit('saveEdit', fieldData)
      }
    }
  }
</script>
