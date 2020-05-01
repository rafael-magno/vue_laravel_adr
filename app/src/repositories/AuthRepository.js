import Repository from './Repository'

class AuthRepository extends Repository {
  login(data) {
    this.url = '/auth'
    return this.insert(data)
  }

  logout() {
    this.url = '/auth'
    return this.delete('')
  }

  passwordRecovery(data) {
    this.url = '/auth/password-recovery-link'
    return this.insert(data)
  }

  resetPassword(data) {
    this.url = '/auth/reset-password'
    return this.insert(data)
  }
}

export default new AuthRepository()
