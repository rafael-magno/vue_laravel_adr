import Repository from './Repository';

class ShiftsRepository extends Repository {
  constructor () {
    super('/shifts')
  }
}

export default new ShiftsRepository();
