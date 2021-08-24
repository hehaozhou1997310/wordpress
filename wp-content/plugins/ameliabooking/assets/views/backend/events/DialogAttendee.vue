<template>
  <div class="am-dialog-attendees-inner">
    <!-- Dialog Loader -->
    <div class="am-dialog-loader" v-show="dialogLoading">
      <div class="am-dialog-loader-content">
        <img :src="$root.getUrl+'public/img/spinner.svg'" class=""/>
        <p>{{ $root.labels.loader_message }}</p>
      </div>
    </div>

    <!-- Dialog Content -->
    <div class="am-dialog-scrollable" :class="{'am-edit':eventBooking.id !== 0}" v-if="eventBooking && !dialogLoading" style="overflow-x: hidden;">

      <!-- Dialog Header -->
      <div v-if="showHeader" class="am-dialog-header">
        <el-row>
          <el-col :span="18">
            <h2 v-if="eventBooking.customer">{{ $root.labels.event_edit_attendee }}</h2>
            <h2 v-if="!eventBooking.customer">{{ $root.labels.event_add_attendee }}</h2>
          </el-col>
          <el-col :span="6" class="align-right">
            <el-button @click="closeDialog" class="am-dialog-close" size="small" icon="el-icon-close">
            </el-button>
          </el-col>
        </el-row>
      </div>

      <!-- Form -->
      <el-form v-if="mounted" :model="{bookings: [eventBooking]}" ref="appointment" :rules="rules" label-position="top">
        <!-- Customer -->
        <el-form-item :label="$root.labels.customer + ':'" prop="bookings">
          <el-select
              remote
              :remote-method="searchExistingCustomers"
              v-model="eventBooking.customerId"
              filterable
              clearable
              @clear="searchExistingCustomers"
              :disabled="eventBooking.added !== false"
              :placeholder="$root.labels.customer"
              :loading="loadingCustomers"
          >
            <div class="am-drop">
              <div class="am-drop-create-item" @click="showDialogNewCustomer"
                   v-if="this.$root.settings.additionalCapabilities.canWriteCustomers">
                {{ $root.labels.create_new }}
              </div>
              <el-option
                  v-for="item in customers"
                  :key="item.id"
                  :label="item.firstName + ' ' + item.lastName"
                  :value="item.id"
                  class="am-has-option-meta"
              >
                <span :class="{'am-drop-item-name': item.email}">{{ item.firstName }} {{ item.lastName }}</span>
                <span class="am-drop-item-meta" v-if="item.email">{{ item.email }}</span>
              </el-option>
              <el-option
                  v-if="customers.length === 0"
                  v-for="item in [{customer: {id: 0, firstName: '', lastName: '', email: '', info: JSON.stringify({firstName: '', lastName: '', email: '', phone: ''})}}]"
                  :key="item.customer.id"
                  :label="item.firstName + ' ' + item.lastName"
                  :value="item"
                  class="am-has-option-meta"
                  :style="{'display': 'none'}"
              >
              </el-option>
            </div>
          </el-select>
        </el-form-item>

        <el-form-item :label="$root.labels.event_book_persons + ':'">
          <el-input-number v-model="eventBooking.persons" :min="1">
          </el-input-number>
        </el-form-item>

        <!-- Event Coupon -->
        <el-form-item :label="$root.labels.coupon"
                      v-if="couponsFilteredEvent.length > 0 && showCoupon && ($root.settings.role === 'admin' || $root.settings.role === 'manager')">
          <el-select
              v-model="eventBooking.coupon"
              filterable
              clearable
              :placeholder="$root.labels.select_coupon"
              :disabled="$root.settings.role === 'customer'"
          >
            <el-option
                v-for="item in couponsFilteredEvent"
                :disabled="item.disabled"
                :key="item.id"
                :label="item.code"
                :value="item.id">
            </el-option>
          </el-select>
          <img :src="$root.getUrl+'public/img/oval-spinner.svg'" class="svg is-spinner"/>
        </el-form-item>

        <dialog-custom-fields
            :appointment="{bookings: [eventBooking]}"
            :entityId="eventId"
            entityType="event"
            :customFields="options.entities.customFields"
            :is-cabinet="isCabinet"
            @clearValidation="clearValidation"
            :showCustomerInfo="false"
        >
        </dialog-custom-fields>
      </el-form>
    </div>

    <!-- Dialog Actions -->
    <dialog-actions
        v-if="eventBooking && !dialogLoading"
        formName="appointment"
        :urlName="eventBooking.id !== 0 ? 'events/bookings' : 'bookings'"
        :isNew="eventBooking.id === 0"
        :entity="eventBooking"
        :getParsedEntity="getParsedEntity"
        @errorCallback="errorCallback"
        @validationBookingsFailCallback="validationBookingsFailCallback"
        :hasIcons="true"

        :status="{
          on: 'visible',
          off: 'hidden'
        }"

        :action="{
          haveAdd: true,
          haveEdit: true,
          haveStatus: false,
          haveRemove: false,
          haveRemoveEffect: false,
          haveDuplicate: false
        }"

        :message="{
          success: {
            save: $root.labels.event_attendee_saved,
            remove: '',
            show: '',
            hide: ''
          },
          confirm: {
            remove: '',
            show: '',
            hide: '',
            duplicate: ''
          }
        }"
    >
    </dialog-actions>

    <div>
      <!-- Dialog Loader -->
      <div class="am-dialog-loader" v-show="dialogLoading">
        <div class="am-dialog-loader-content">
          <img :src="$root.getUrl+'public/img/spinner.svg'" class="">
          <p>{{ $root.labels.loader_message }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import DialogActions from '../parts/DialogActions.vue'
  import imageMixin from '../../../js/common/mixins/imageMixin'
  import dateMixin from '../../../js/common/mixins/dateMixin'
  import notifyMixin from '../../../js/backend/mixins/notifyMixin'
  import entitiesMixin from '../../../js/common/mixins/entitiesMixin'
  import appointmentPriceMixin from '../../../js/backend/mixins/appointmentPriceMixin'
  import priceMixin from '../../../js/common/mixins/priceMixin'
  import DialogCustomFields from '../parts/DialogCustomFields'
  import customFieldMixin from '../../../js/common/mixins/customFieldMixin'
  import customerMixin from '../../../js/backend/mixins/customerMixin'

  export default {

    mixins: [entitiesMixin, imageMixin, dateMixin, notifyMixin, priceMixin, customFieldMixin, appointmentPriceMixin, customerMixin],

    props: {
      eventBooking: null,
      eventId: null,
      eventMaxCapacity: null,
      eventCustomerIds: null,
      eventBookMultipleTimes: {
        required: false,
        default: true,
        type: Boolean
      },
      options: null,
      customerCreatedCount: 0,
      showHeader: {
        required: false,
        default: true,
        type: Boolean
      },
      isCabinet: {
        type: Boolean,
        default: false,
        required: false
      }
    },

    data () {
      return {
        showCoupon: false,
        customers: [],
        appointment: null,
        dialogLoading: true,
        executeUpdate: true,
        mounted: false,
        statusMessage: '',
        rules: {
          bookings: []
        }
      }
    },

    mounted () {
      this.appointment = {
        bookings: [this.eventBooking]
      }
      this.instantiateDialog()
      this.setBookingCustomFields()
      this.addCustomFieldsValidationRules()
    },

    updated () {
      this.instantiateDialog()
    },

    methods: {
      customersFetched () {
        this.customers = this.searchedCustomers
      },

      searchExistingCustomers (query) {
        if (query) {
          this.searchCustomers(query, this.customersFetched)
        } else {
          this.customers = this.options.entities.customers
        }
      },

      showDialogNewCustomer () {
        this.$emit('showDialogNewCustomer')
      },

      instantiateDialog () {
        if (this.eventBooking !== null && this.executeUpdate === true) {
          this.mounted = true
          this.executeUpdate = false
          this.dialogLoading = false

          if (parseInt(this.eventBooking.id) !== 0) {
            this.customers = this.options.entities.customers
          } else {
            this.showCoupon = true
            if (this.eventBookMultipleTimes) {
              this.customers = this.options.entities.customers
            } else {
              this.customers = this.options.entities.customers.filter(customer => this.eventCustomerIds.indexOf(customer.id) === -1)
            }
          }
        }
      },

      closeDialog () {
        this.$emit('closeDialog')
      },

      getParsedEntity () {
        for (let key in this.eventBooking.customFields) {
          if (this.eventBooking.customFields[key].type === 'datepicker' && this.eventBooking.customFields[key].value) {
            this.eventBooking.customFields[key].value = this.getStringFromDate(this.eventBooking.customFields[key].value)
          }
        }

        let couponId = this.showCoupon ? this.eventBooking.coupon : (this.eventBooking.coupon ? this.eventBooking.coupon.id : null)

        let coupon = this.options.entities.coupons ? this.options.entities.coupons.find(c => c.id === couponId) : null

        return {
          type: 'event',
          eventId: this.eventId,
          bookings: [
            {
              customFields: this.eventBooking.customFields,
              persons: this.eventBooking.persons,
              customerId: this.eventBooking.customerId,
              customer: this.customers.find(customer => customer.id === this.eventBooking.customerId),
              coupon: coupon,
              deposit: 0
            }
          ],
          couponCode: coupon ? coupon.code : null,
          validateCoupon: false,
          locale: '',
          timeZone: '',
          payment: {
            gateway: 'onSite'
          }
        }
      },

      clearValidation () {
        if (typeof this.$refs.eventBooking !== 'undefined') {
          this.$refs.eventBooking.clearValidate()
        }
      },

      errorCallback (responseData) {
        let $this = this

        setTimeout(function () {
          if ('timeSlotUnavailable' in responseData.data && responseData.data.timeSlotUnavailable === true) {
            $this.notify($this.$root.labels.error, $this.$root.labels.maximum_capacity_reached, 'error')
          }
        }, 200)
      },

      addCustomFieldsValidationRules () {
        // Go through all custom fields
        for (let j = 0; j < this.options.entities.customFields.length; j++) {
          // Check if custom fields is assigned to selected service
          if (this.isCustomFieldVisible(this.options.entities.customFields[j], 'event', this.eventId)) {
            if (typeof this.rules.bookings[0] === 'undefined') {
              this.$set(this.rules.bookings, 0, {type: 'array'})
            }

            if (typeof this.rules.bookings[0].customFields === 'undefined') {
              this.$set(this.rules.bookings[0], 'customFields', {})
            }

            this.rules.bookings[0].customFields[this.options.entities.customFields[j].id] = {
              value: [
                {required: true, message: this.$root.labels.required_field, trigger: 'submit'}
              ]
            }
          }
        }
      },

      showCustomFieldsTab () {
        let eventsIdsWithCustomField = Array.prototype.concat.apply(
          [], this.options.entities.customFields.map(customField => customField.events.map(event => event.id))
        )

        return this.options.entities.customFields.length > 0 &&
          this.booking !== null &&
          this.eventId &&
          eventsIdsWithCustomField.includes(this.eventId)
      },

      validationBookingsFailCallback () {
      }
    },

    watch: {
      'customerCreatedCount' () {
        this.customers = this.options.entities.customers

        this.eventBooking.customerId = this.customers[this.customers.length - 1].id

        this.customers.sort(function (a, b) {
          return (a.firstName + ' ' + a.lastName).localeCompare((b.firstName + ' ' + b.lastName))
        })
      }
    },

    components: {
      DialogCustomFields,
      DialogActions
    }

  }
</script>
