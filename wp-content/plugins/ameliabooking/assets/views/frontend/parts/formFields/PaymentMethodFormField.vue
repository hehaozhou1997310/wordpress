<template>
    <el-form-item
      v-if="totalPrice > 0 && !this.$root.settings.payments.wc.enabled && paymentOptions.length > 1"
      :class="$root.settings.customization.forms ? `am-select-${classIdentifier}`: ''"
    >
      <template slot="label">
        <span :style="{fontWeight: 700}">
          {{ labelPaymentMethod || $root.labels.payment_method_colon }}
        </span>
      </template>
      <el-select
        v-model="appointment.payment.gateway"
        :popper-class="$root.settings.customization.forms ? `am-dropdown-${classIdentifier}` : ''"
        placeholder=""
        @change="changeItem"
      >
        <el-option
          v-for="item in paymentOptions"
          :key="item.value"
          :label="item.label"
          :value="item.value"
          :style="{'color': appointment.payment.gateway === item.value ? bookableColor : ''}"
        >
        </el-option>
      </el-select>
    </el-form-item>
</template>

<script>
export default {
  name: 'paymentMethodFormField',

  props: {
    totalPrice: {
      type: String
    },
    bookableColor: {
      type: String
    },
    paymentOptions: {
      type: Array,
      default: () => []
    },
    appointment: {
      type: Object,
      default: () => {}
    },
    classIdentifier: {
      type: String,
      default: ''
    },
    formField: {
      type: Object,
      default: () => {}
    }
  },

  data () {
    return {
      labelPaymentMethod: this.formField[this.$options.name].labels.payment_method_colon.value
    }
  },

  mounted () {},

  methods: {
    changeItem () {
      this.$emit('changeItem')
    }
  }
}
</script>
