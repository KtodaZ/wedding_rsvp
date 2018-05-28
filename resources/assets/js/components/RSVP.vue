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
                    <div id="rsvp-form" v-if="attendee.name" key="rsvpForm">
                        <form class="form-horizontal" method="post" @submit.prevent="onFormSubmit">
                            <fieldset>
                                <div>
                                    <transition name="fadeRight" mode="out-in" leave-active-class="fadeOutLeft">
                                        <div class="form-group" v-if="attending && attendee.replied">
                                            <div class="Form">
                                                <div class="Form-Header"> Here are some links you might find useful:
                                                </div>
                                                <div class="Form-container">
                                                    <p v-if="attendee.eventContacts.length === 0 || (attendee.eventContacts.length === 1 && !attendee.eventContacts[0]['email'])" class="norm-text">P.S. - We will email you this information if you enter your email (at the bottom of this page).</p>
                                                    <p v-else class="norm-text"> P.S. - We sent you this list to your email. Please check your spam folder.</p>

                                                    <!--Aligned same way the questions are aligned-->
                                                    <p class="norm-text"> We have reserved a block of rooms at the
                                                        Residence Inn Marriott at Capitol Park.
                                                        <a class="link" target="_blank" href="https://bit.ly/2LhKkVB">Click
                                                            here</a> to book with our reduced rate before July 5th! </p>

                                                    <p class="norm-text"> Noelle and Kyle are registered at <a
                                                            class="link" target="_blank"
                                                            href="https://www.amazon.com/wedding/share/szombathyceane">Amazon</a>
                                                        and <a class="link" target="_blank"
                                                               href="https://www.crateandbarrel.com/gift-registry/noelle-ceane-and-kyle-szombathy/r5840478">Crate
                                                            & Barrel</a>,
                                                        or you can help by donating to their <a class="link"
                                                                                                target="_blank"
                                                                                                href="https://www.pinterest.com/szombaceane/ceane-szombathy-newlywed-fund/">Newlywed
                                                            Fund</a>.</p>
                                                </div>
                                            </div>

                                            <div class="Form">
                                                <div class="Form-Header">Find your way to the venue:</div>
                                                <div class="row Form-container">
                                                    <div class="col-xs-12 col-lg-8 col-lg-offset-2">
                                                        <div class="embed-responsive embed-responsive-4by3">
                                                            <iframe class="embed-responsive-item"
                                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3 !1d3119.6682520664313!2d-121.48556418367403!3d38.564456579623375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x809ad0e6827ed9eb%3A0xc13f4271c33deb4c!2sVizcaya!5e0!3m2!1sen!2sus!4v1526836010023"
                                                                    allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </transition>

                                    <div class="form-group" v-if="!attendee.replied">
                                        <div class="Form">
                                            <div class="Form-Header">Will you be attending?</div>
                                            <div class="Form-container">
                                                <label class="norm-text col-md-6 col-xs-12">
                                                    <input type="radio" id="yesRadio" :value="true" v-model="attending"
                                                           v-on:click="setNumAttendingBtnColor()">
                                                    YES. Let's party!
                                                </label>
                                                <label class="norm-text col-md-6 col-xs-12">
                                                    <input type="radio" id="noRadio" :value="false" v-model="attending"
                                                           v-on:click="setNumAttending(0)">
                                                    NO.
                                                    Will be
                                                    at home watching Netflix.
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <transition name="fadeRight" mode="out-in" leave-active-class="fadeOutLeft">
                                        <div class="form-group" v-if="attending && !attendee.replied">
                                            <div class="Form">
                                                <div class="Form-Header">How many total in your party?</div>
                                                <div class="Form-container">
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


                                    <transition name="fadeRight" mode="out-in" leave-active-class="fadeOutLeft">
                                        <div class="form-group" v-if="attendee.numAttending > 0 && attending">
                                            <div class="Form">
                                                <div v-if="attendee.replied && attending" class="Form-Header">Edit your
                                                    email preferences? Here's what we have for you:
                                                </div>
                                                <div v-else class="Form-Header">Enter one or more emails to receive
                                                    updates (optional)
                                                </div>
                                                <div class="Form-container">
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
                                                              v-on:click="attendee.eventContacts.push({ email: '' })">+ Add Another Email</span>
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
                                    <div class="Form">
                                        <label class="Form-Header" for="code">Enter your code:</label>
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
            },
            clog(obj) {
                console.log(obj);
            }
        }
    }
</script>

<style scoped>

</style>