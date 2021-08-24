<template>
  <div>
    <div v-if="hasTranslation">
      <el-row type="flex" align="middle" :gutter="24" style="margin-bottom: 5px;">
        <el-col :span="12">
          {{ label }}
        </el-col>

        <el-col :span="12">
          <div class="am-service-translate am-event-translate" @click="showDialogTranslate" style="cursor: pointer;">
            <img class="am-dialog-translate-svg" width="16px" :src="$root.getUrl+'public/img/translate.svg'">
            {{ $root.labels.translate }}
          </div>
        </el-col>
      </el-row>

      <el-button-group style="margin-bottom: 5px;">
        <el-button size="mini" :type="isTextMode ? 'default' : 'primary'" @click="textModeChanged">{{ $root.labels.text_mode }}</el-button>
        <el-button size="mini" :type="isTextMode ? 'primary' : 'default'" @click="textModeChanged">{{ $root.labels.html_mode }}</el-button>
      </el-button-group>
    </div>
    <div v-else style="margin-bottom: 5px;">
      <el-row type="flex" align="middle" :gutter="24">
        <el-col :span="12">
          {{ label }}
        </el-col>

        <el-col :span="12" class="align-right">
          <el-button-group>
            <el-button size="mini" :type="isTextMode ? 'default' : 'primary'" @click="textModeChanged">{{ $root.labels.text_mode }}</el-button>
            <el-button size="mini" :type="isTextMode ? 'primary' : 'default'" @click="textModeChanged">{{ $root.labels.html_mode }}</el-button>
          </el-button-group>
        </el-col>
      </el-row>
    </div>

    <el-input
      v-if="isTextMode"
      type="textarea"
      :autosize="{minRows: 4, maxRows: 6}"
      placeholder=""
      v-model="textValue"
      @input="changedContentText"
    >
    </el-input>
    <quill-editor
        v-else
        v-model="entity[htmlProperty]"
        :options="{
          modules: {
            toolbar: [
              ['bold', 'italic', 'underline', 'strike'],
              ['blockquote'],
              [{'list': 'ordered'}, {'list': 'bullet'}],
              [{'script': 'sub'}, {'script': 'super'}],
              [{'indent': '-1'}, {'indent': '+1'}],
              [{'direction': 'rtl'}],
              [{'size': ['small', false, 'large', 'huge']}],
              [{'header': [1, 2, 3, 4, 5, 6, false]}],
              [{'font': []}],
              [{'color': []}, {'background': []}],
              [{'align': []}],
              ['clean'],
              allowImage ? ['link', 'image'] : ['link']
            ]
          }
        }"
    >
    </quill-editor>
  </div>
</template>

<script>
import { quillEditor } from 'vue-quill-editor'
import quillMixin from '../../../js/backend/mixins/quillMixin'

export default {
  mixins: [quillMixin],

  props: {
    textMode: null,
    allowImage: false,
    hasTranslation: true,
    label: '',
    entity: null,
    textProperty: '',
    htmlProperty: ''
  },

  data () {
    return {
      textValue: '',
      isTextMode: false
    }
  },

  mounted () {
    if (!(this.textProperty in this.entity) || this.entity[this.textProperty] === null) {
      this.entity[this.textProperty] = ''
    }

    if (!(this.htmlProperty in this.entity) || this.entity[this.htmlProperty] === null) {
      this.entity[this.htmlProperty] = ''
    }

    this.$nextTick(() => {
      this.isTextMode = this.textMode

      this.textValue = this.entity[this.textProperty]

      this.entity[this.htmlProperty] = this.entity[this.textProperty]

      if (this.entity[this.textProperty].startsWith('<!-- Amelia Content -->')) {
        this.isTextMode = false
      }

      if (this.isTextMode) {
        this.entity[this.textProperty] = this.entity[this.textProperty].replace('<!-- Amelia Content -->', '')
      }
    })
  },

  methods: {
    changedContentText () {
      this.entity[this.textProperty] = this.process(
        this.textValue.replace('<!-- Amelia Content -->', '').replace(/(\r\n|\n|\r)/gm, '')
      )
      this.entity[this.htmlProperty] = this.entity[this.textProperty]
    },

    showDialogTranslate () {
      this.$emit('showDialogTranslate')
    },

    textModeChanged () {
      this.isTextMode = !this.isTextMode

      if (this.isTextMode) {
        this.entity[this.textProperty] = this.process(
          this.entity[this.htmlProperty].replace('<!-- Amelia Content -->', '').replace(/(\r\n|\n|\r)/gm, '')
        )
      } else {
        this.entity[this.textProperty] = '<!-- Amelia Content -->' + this.entity[this.textProperty]
        this.entity[this.htmlProperty] = this.entity[this.textProperty]
      }

      this.textValue = this.entity[this.textProperty]
    }
  },

  components: {
    quillEditor
  }
}
</script>
