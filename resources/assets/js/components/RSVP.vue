<template>
    <div id="mainContainer1" class="main-container" style="height: 100%;">
        <div id="mainContainer2" class="main-container">
            <div class="header-container">
                <div class="body-area" style="padding: 0;">

                    <transition appear name="fadeRightBig" mode="out-in" leave-active-class="fadeOutLeft">
                        <div v-if="doneWithRsvp" key="rsvpSuccess">
                            <div class="legend-header h1">
                                <span class="h1">Awesome, {{attendee.name}}! You're all done!</span>
                            </div>
                            <div v-if="attending">
                                <div class="legend-header h1">
                                    <span class="h1">We've reserved </span>
                                    <span class="h1" style="color: #2C57F6;">{{ attendee.numAttending }}</span>
                                    <span v-if="attendee.numAttending === 1" class="h1"> seat for you.</span>
                                    <span v-else class="h1"> seats for you.</span>
                                </div>
                            </div>
                            <div v-else class="legend-header">
                                <span class="h2">We're sorry that you can't make it! We'll miss you!</span>
                            </div>
                        </div>
                        <div v-else-if="attendee.name" key="codeSuccessHeader" class="legend-header">
                            <div class="h1">Welcome, {{attendee.name}}!
                            </div>
                            <div class="h2" v-if="attendee.replied && attending">
                                <span class="h2">It looks like you've already RSVP'd! We're holding </span>
                                <span class="h2" style="color: #2C57F6;">{{ attendee.numAttending }}</span>
                                <span v-if="attendee.numAttending === 1" class="h2"> seat for you.</span>
                                <span v-else class="h2"> seats for you.</span>
                                <span class="h2">You can edit your notification preferences now if you'd like.</span>
                            </div>
                            <div class="h2" v-else-if="attendee.replied && !attending">It looks like you've already
                                RSVP'd. We're sorry you can't make it!
                            </div>
                        </div>
                        <div v-else-if="!attendee.name" key="noCodeHeader">
                            <div class="legend-header">
                                <span style="margin-left: -0.2rem;" class="h1">You're in the right place!</span>
                                <br/>
                                <span class="h2">Let's get your RSVP started</span>
                            </div>
                            <div class="Envelope-top-box" style="padding: 0;">
                                <img class="Envelope-top-img" :src="envelope_img_src">
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
            <div class="body-area">

                <transition name="fadeRightBig" mode="out-in" leave-active-class="fadeOutLeft">
                    <div v-if="doneWithRsvp">

                    </div>

                    <div id="rsvp-form" v-else-if="attendee.name" key="rsvpForm">
                        <form class="form-horizontal" method="post" @submit.prevent="onFormSubmit">
                            <fieldset>
                                <div>
                                    <div class="form-group" v-if="!attendee.replied">
                                        <div class="Input">
                                            <div class="Form-entry">Will you be attending?</div>
                                            <div class="Input-container">
                                                <label class="entry-text col-md-6 col-xs-12">
                                                    <input type="radio" id="yesRadio" :value="true" v-model="attending"
                                                           v-on:click="setNumAttendingBtnColor()">
                                                    YES. Let's party!
                                                </label>
                                                <label class="entry-text col-md-6 col-xs-12">
                                                    <input type="radio" id="noRadio" :value="false" v-model="attending"
                                                           v-on:click="setNumAttending(0)">
                                                    NO.
                                                    Will be
                                                    at home watching Netflix.
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <transition name="fadeRight">
                                        <div class="form-group" v-if="attending && !attendee.replied">
                                            <div class="Input">
                                                <div class="Form-entry">How many total in your party?</div>
                                                <div class="Input-container">
                                                    <button type="button" class="Choice-Button"
                                                            v-for="n in (attendee.numPlusOnesAllowed + 1)"
                                                            v-on:click="setNumAttending(n)"
                                                            :id="'numAttendingBtn'+n"
                                                            :key="n">
                                                        {{n}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </transition>


                                    <transition name="fadeRight">
                                        <div class="form-group" v-if="attendee.numAttending > 0 && attending">
                                            <div class="Input">
                                                <div class="Form-entry">Enter your email to receive updates (optional)
                                                </div>
                                                <div class="Input-container">
                                                    <transition-group name="fadeRight" tag="p" leave-active-class="">
                                                        <div v-for="(contact, index) in attendee.eventContacts"
                                                             :key="index">
                                                            <div class="input-group" style="padding-bottom: 1rem;">
                                                                <input type="email"
                                                                       class="Input-text"
                                                                       placeholder="e.g. john.doe@example.com"
                                                                       v-bind:key="index"
                                                                       v-model="contact.email">
                                                                <div class="input-group-btn">
                                                                    <i v-on:click="removeContact(index)"
                                                                       style="cursor: pointer; padding: 0.5rem;"
                                                                       aria-label="Remove Email"
                                                                       class="glyphicon glyphicon-remove">
                                                                    </i>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </transition-group>
                                                    <div>
                                                        <span class="Hint-clickable"
                                                              v-on:click="attendee.eventContacts.push({ email: '' })">+ Add Another</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </transition>

                                    <div class="form-group">
                                        <div class="col-md-12 text-right">
                                            <transition name="fadeRight">
                                                <button v-if="attendee.numAttending != null && attending != null"
                                                        type="submit" class="Button">
                                                    Submit
                                                </button>
                                            </transition>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
                    </div>

                    <div v-else key="codeForm">
                        <form class="form-horizontal" method="post" @submit.prevent="onCodeSubmit">

                            <div class="col-md-8" style="padding: 0;">
                                <div class="form-group">
                                    <div class="Input">
                                        <label class="Form-entry" for="code">Enter your code:</label>
                                        <input id="code"
                                               v-model="code"
                                               type="text"
                                               class="Input-text"
                                               placeholder="e.g. LOVEBIRDS29">
                                    </div>
                                    <div class="Hint-text ">(Hint: it's on your invitation)</div>
                                    <div v-if="errors" class="Error-text">{{ errors[0] }}</div>
                                    <div class="text-right">
                                        <transition name="fadeRight">
                                            <button v-if="code.length >= minLengthOfCode" type="submit" class="Button">
                                                Onward march
                                                <span class="glyphicon glyphicon-chevron-right"
                                                      aria-hidden="true"></span>
                                            </button>
                                        </transition>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 Envelope-bottom-box" style="padding: 0;">
                                <img class="Envelope-bottom-img" :src="envelope_img_src">
                            </div>
                        </form>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "rsvp",

        data() {
            return {
                errors: [],
                endpoint: 'api/rsvp',
                code: '',
                attending: null,
                minLengthOfCode: 5,
                doneWithRsvp: false,
                attendee: {
                    name: null,
                    numPlusOnesAllowed: null,
                    numAttending: null,
                    replied: null,
                    eventContacts: []
                },
                envelope_img_src: '/images/Envelope.png'
            };
        },

        methods: {
            onCodeSubmit: function () {
                this.clearErrors();
                this.code = this.code.replace(/\W/g, '');
                axios.get(this.endpoint + '/code/' + this.code)
                    .then(({data}) => {
                        this.handleSuccessfulResponse(data);
                    })
                    .catch(({response}) => {
                            this.errors = {0: 'Hmmm. That code doesn\'t seem correct. Try checking the spelling one more time?'}
                        }
                    );
            },
            onFormSubmit: function () {
                this.clearErrors();
                axios.put(this.endpoint + '/code/' + this.code, this.attendee)
                    .then(({data}) => {
                        this.handleSuccessfulResponse(data);
                        this.doneWithRsvp = true;
                    })
                    .catch(({response}) => {
                            this.errors = {0: 'Hmmm. That code doesn\'t seem correct. Try checking the spelling one more time?'}
                        }
                    );
            },
            handleSuccessfulResponse(data) {
                this.clearErrors();
                this.attendee = data;
                this.setAttending();
                if (this.attendee.eventContacts.length === 0) {
                    this.attendee.eventContacts.push({email: ''});
                }
                window.scrollTo(0, 0);
            },
            clearErrors: function () {
                this.errors = [];
            },
            setNumAttending(numAttending) {
                this.attendee.numAttending = numAttending;
                this.setNumAttendingBtnColor();
            },
            setNumAttendingBtnColor() {
                this.clearNumAttendingButtons();
                $('#numAttendingBtn' + this.attendee.numAttending).css('borderColor', '#f4b813').css('color', '#f4b813');
            },
            clearNumAttendingButtons() {
                for (let n = 1; n <= (this.attendee.numPlusOnesAllowed + 1); n++) {
                    $('#numAttendingBtn' + n).css('borderColor', '#3c4956').css('color', '#3c4956');
                }
            },
            removeContact(n) {
                this.attendee.eventContacts.splice(n, 1);
            },
            setAttending() {
                this.attending = (this.attendee.numAttending > 0) ? true : null;
            }
        }
    }
</script>

<style scoped>

</style>