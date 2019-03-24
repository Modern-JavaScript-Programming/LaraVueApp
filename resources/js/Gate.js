export default class Gate {
  constructor (user) {
    this.user = user
  }

  isSuperAdmin () {
    return this.user.type === 'super-admin'
  }

  isAdmin () {
    return this.user.type === 'admin'
  }

  isEngagementLead () {
    return this.user.type === 'engagement-lead'
  }

  isFinanceUser () {
    return this.user.type === 'financeuser'
  }

  isStakeholder () {
    return this.user.type === 'stakeholder'
  }
}
